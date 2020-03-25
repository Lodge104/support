<?php
/*********************************************************************
    class.model.php

    Peter Rotich <peter@osticket.com>
    Copyright (c)  2006-2014 osTicket
    http://www.osticket.com

    Released under the GNU General Public License WITHOUT ANY WARRANTY.
    See LICENSE.TXT for details.

    vim: expandtab sw=4 ts=4 sts=4:
**********************************************************************/

// TODO:  Make ObjectModel models base class and extend VerySimpleModel
class ObjectModel {

<<<<<<< HEAD
<<<<<<< HEAD
    const OBJECT_TYPE_TICKET       = 'T';
    const OBJECT_TYPE_THREAD       = 'H';
    const OBJECT_TYPE_USER         = 'U';
    const OBJECT_TYPE_ORG          = 'O';
    const OBJECT_TYPE_FAQ          = 'K';
    const OBJECT_TYPE_FILE         = 'F';
    const OBJECT_TYPE_TASK         = 'A';
    const OBJECT_TYPE_TEAM         = 'E';
    const OBJECT_TYPE_DEPT         = 'D';
    const OBJECT_TYPE_STAFF        = 'S';
    const OBJECT_TYPE_CHILD_TICKET = 'C';
=======
=======
>>>>>>> parent of 7a62b76... Merge branch 'master' of https://github.com/Lodge104/support
    const OBJECT_TYPE_TICKET = 'T';
    const OBJECT_TYPE_THREAD = 'H';
    const OBJECT_TYPE_USER   = 'U';
    const OBJECT_TYPE_ORG    = 'O';
    const OBJECT_TYPE_FAQ    = 'K';
    const OBJECT_TYPE_FILE   = 'F';
    const OBJECT_TYPE_TASK   = 'A';
<<<<<<< HEAD
>>>>>>> parent of 7093d97... 2020 Update
=======
    const OBJECT_TYPE_TEAM   = 'E';
    const OBJECT_TYPE_DEPT   = 'D';
    const OBJECT_TYPE_STAFF  = 'S';
>>>>>>> parent of 7a62b76... Merge branch 'master' of https://github.com/Lodge104/support

    private function objects() {
        static $objects = false;
        if ($objects == false) {
            $objects = array(
<<<<<<< HEAD
<<<<<<< HEAD
                self::OBJECT_TYPE_TICKET        => 'Ticket',
                self::OBJECT_TYPE_THREAD        => 'ThreadEntry',
                self::OBJECT_TYPE_USER          => 'User',
                self::OBJECT_TYPE_ORG           => 'Organization',
                self::OBJECT_TYPE_FAQ           => 'FAQ',
                self::OBJECT_TYPE_FILE          => 'AttachmentFile',
                self::OBJECT_TYPE_TASK          => 'Task',
                self::OBJECT_TYPE_TEAM          => 'Team',
                self::OBJECT_TYPE_DEPT          => 'Dept',
                self::OBJECT_TYPE_STAFF         => 'Staff',
                self::OBJECT_TYPE_CHILD_TICKET  => 'Ticket',
            );
=======
=======
>>>>>>> parent of 7a62b76... Merge branch 'master' of https://github.com/Lodge104/support
                    self::OBJECT_TYPE_TICKET  => 'Ticket',
                    self::OBJECT_TYPE_THREAD  => 'ThreadEntry',
                    self::OBJECT_TYPE_USER    => 'User',
                    self::OBJECT_TYPE_ORG     => 'Organization',
                    self::OBJECT_TYPE_FAQ     => 'FAQ',
                    self::OBJECT_TYPE_FILE    => 'AttachmentFile',
                    self::OBJECT_TYPE_TASK    => 'Task',
<<<<<<< HEAD
                    );
>>>>>>> parent of 7093d97... 2020 Update
=======
                    self::OBJECT_TYPE_TEAM    => 'Team',
                    self::OBJECT_TYPE_DEPT    => 'Dept',
                    self::OBJECT_TYPE_STAFF   => 'Staff',
                    );
>>>>>>> parent of 7a62b76... Merge branch 'master' of https://github.com/Lodge104/support
        }

        return $objects;
    }

    static function getType($model) {

        foreach (self::objects() as $t => $c) {
            if ($model instanceof $c)
                return $t;
        }
    }

    static function lookup($id, $type) {
        $model = null;
        if ($id
                && ($objects=self::objects())
                && ($class=$objects[$type])
                && class_exists($class)
                && is_callable(array($class, 'lookup')))
            $model = $class::lookup($id);

        return $model;
    }
}
?>
