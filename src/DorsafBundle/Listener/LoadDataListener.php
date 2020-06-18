<?php

namespace DorsafBundle\Listener;

use AncaRebeca\FullCalendarBundle\Event\CalendarEvent;
use AncaRebeca\FullCalendarBundle\Model\Event;
use AncaRebeca\FullCalendarBundle\Model\FullCalendarEvent;
use DorsafBundle\Entity\Event as myEvent;
use DateTime;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;

class LoadDataListener
{
    /**
     * @var EntityManager
     */
    private $em;

    public function __construct(EntityManagerInterface $em, Security $security)
    {
        $this->em = $em;
        $this->security = $security;
    }

    /**
     * @param CalendarEvent $calendarEvent
     *
     * @return FullCalendarEvent[]
     */

    public function loadData(CalendarEvent $calendarEvent)
    {
// You can retrieve information from the event dispatcher (eg, You may want which day was selected in the calendar):
// $startDate = $calendarEvent->getStart();
// $endDate = $calendarEvent->getEnd();
// $filters = $calendarEvent->getFilters();
// You may want do a custom query to populate the events
// $currentEvents = $repository->findByStartDate($startDate);
       // /**@var User $user */
      //  $user = $this->security->getUser();
//  $responsable = $user->getResponsable();

        $repository = $this->em->getRepository(myEvent::class)->findAll();
//  $schedules = $repository->findBy(array('responsable'=>$responsable));
// You may want to add an Event into the Calendar view.
        /** @var myEvent $schedule */
        foreach ($repository as $schedule) {
            /** affichage fil calendar**/
           // $result = $schedule->getDatedebutEvent()->format('Y-m-d H:i:s');
            $datetime =  $schedule->getDatedebutEvent();
            $datetime->modify('+1 day');

// $schedule->setDateFin($date) ;
            $event = new Event($schedule->getNomEvent(), $schedule->getDatedebutEvent());
//          $event->setStartDate($schedule->getDateDebut());

            $event->setEndDate($datetime);
            $event->setEditable(true);
            $event->setStartEditable(true);
            $event->setId($schedule->getId());
            $color = "#FF0000";
            $color = "";
            if ($schedule->getCategorieEvent() == 'Culturel') {
                $color = '#00FF00';
            } elseif ($schedule->getCategorieEvent()== 'music') {
                $color = 'light blue';
            } else {
                $color = 'purple';
            }
            $event->setColor($color);
           // $event->setColor($color);

            $event->setDurationEditable( true );


            $calendarEvent->addEvent($event);
        }
    }
}


?>