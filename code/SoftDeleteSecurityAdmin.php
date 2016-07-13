<?php

/**
 * Add gridfield action to SecurityAdmin
 *
 * @author Koala
 */
class SoftDeleteSecurityAdmin extends Extension
{

    function updateEditForm(Form $form)
    {
        /* @var $owner SecurityAdmin */
        $owner = $this->owner;

        $memberSingl = singleton('Member');
        $groupSingl  = singleton('Group');

        if ($memberSingl->hasExtension('SoftDeletable')) {
            $gridfield = $form->Fields()->dataFieldByName('Members');
            $config    = $gridfield->getConfig();

            $config->removeComponentsByType('GridFieldDeleteAction');
            $config->addComponent(new GridFieldSoftDeleteAction());

            // No caution because soft :-)
            $form->Fields()->removeByName('MembersCautionText');
        }

        if ($groupSingl->hasExtension('Groups')) {
            $gridfield = $form->Fields()->dataFieldByName('Members');
            $config    = $gridfield->getConfig();

            $config->removeComponentsByType('GridFieldDeleteAction');
            $config->addComponent(new GridFieldSoftDeleteAction());
        }
    }
}