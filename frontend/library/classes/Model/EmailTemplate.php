<?php
/**
 * i-MSCP - internet Multi Server Control Panel
 * Copyright (C) 2010-2018 by Laurent Declercq <l.declercq@nuxwin.com>
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

namespace iMSCP\Model;

/**
 * Class EmailTemplate
 * @package iMSCP\Model
 */
class EmailTemplate extends BaseModel
{
    /**
     * @var int
     */
    private $emailTemplateID;

    /**
     * @var int
     */
    private $userID;

    /**
     * @var string
     */
    private $emailTemplateName;

    /**
     * @var string
     */
    private $emailTemplateSubject;

    /**
     * @var string
     */
    private $emailTemplateBody;

    /**
     * @return int
     */
    public function getEmailTemplateID(): int
    {
        return $this->emailTemplateID;
    }

    /**
     * @param int $emailTemplateID
     * @return EmailTemplate
     */
    public function setEmailTemplateID(int $emailTemplateID): EmailTemplate
    {
        $this->emailTemplateID = $emailTemplateID;
        return $this;
    }

    /**
     * @return int
     */
    public function getUserID(): int
    {
        return $this->userID;
    }

    /**
     * @param int $userID
     * @return EmailTemplate
     */
    public function setUserID(int $userID): EmailTemplate
    {
        $this->userID = $userID;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmailTemplateName(): string
    {
        return $this->emailTemplateName;
    }

    /**
     * @param string $emailTemplateName
     * @return EmailTemplate
     */
    public function setEmailTemplateName(string $emailTemplateName): EmailTemplate
    {
        $this->emailTemplateName = $emailTemplateName;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmailTemplateSubject(): string
    {
        return $this->emailTemplateSubject;
    }

    /**
     * @param string $emailTemplateSubject
     * @return EmailTemplate
     */
    public function setEmailTemplateSubject(string $emailTemplateSubject): EmailTemplate
    {
        $this->emailTemplateSubject = $emailTemplateSubject;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmailTemplateBody(): string
    {
        return $this->emailTemplateBody;
    }

    /**
     * @param string $emailTemplateBody
     * @return EmailTemplate
     */
    public function setEmailTemplateBody(string $emailTemplateBody): EmailTemplate
    {
        $this->emailTemplateBody = $emailTemplateBody;
        return $this;
    }
}