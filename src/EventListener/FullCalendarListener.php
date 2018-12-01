<?php
/**
 * Created by PhpStorm.
 * User: jarngotostos
 * Date: 12/1/18
 * Time: 10:25 PM
 */

namespace App\EventListener;

use App\Entity\Event as Calendar;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Toiba\FullCalendarBundle\Entity\Event;
use Toiba\FullCalendarBundle\Event\CalendarEvent;

class FullCalendarListener
{
    private $em;
    private $router;

    public function __construct(EntityManagerInterface $em, UrlGeneratorInterface $router)
    {
        $this->em = $em;
        $this->router = $router;
    }

    public function loadEvents(CalendarEvent $calendar)
    {
        $startDate = $calendar->getStart();
        $endDate = $calendar->getEnd();
        $filters = $calendar->getFilters();

        $events = $this->em->getRepository(Calendar::class)
            ->createQueryBuilder('e')
            ->andWhere('e.dateStart BETWEEN :startDate and :endDate')
            ->setParameter('startDate', $startDate->format('Y-m-d'))
            ->setParameter('endDate', $endDate->format('Y-m-d'))
            ->getQuery()->getResult();

        foreach($events as $event) {

            $calendarEvent = new Event(
                $event->getTitle(),
                $event->getDateStart(),
                ($event->getDateEnd() == null) ? null : $event->getDateEnd()->modify('+1day')
            );

            /*
             * Optional calendar event settings
             *
             * For more information see : Toiba\FullCalendarBundle\Entity\Event
             * and : https://fullcalendar.io/docs/event-object
             */
            // $bookingEvent->setUrl('http://www.google.com');
            // $bookingEvent->setBackgroundColor($booking->getColor());
            // $bookingEvent->setCustomField('borderColor', $booking->getColor());

            $calendarEvent->setUrl(
                $this->router->generate('event_show', array(
                    'id' => $event->getId(),
                ))
            );

            // finally, add the booking to the CalendarEvent for displaying on the calendar
            $calendar->addEvent($calendarEvent);
        }
    }
}
