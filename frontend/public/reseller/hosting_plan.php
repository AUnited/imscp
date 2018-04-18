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

use iMSCP\TemplateEngine;
use iMSCP_Events as Events;
use iMSCP_Events_Event as Event;
use iMSCP_Registry as Registry;

/**
 * Generate page
 *
 * @param TemplateEngine $tpl
 * @return void
 */
function generatePage($tpl)
{
    $stmt = execQuery('SELECT id, name, status FROM hosting_plans WHERE reseller_id = ? ORDER BY id', [$_SESSION['user_id']]);
    if (!$stmt->rowCount()) {
        $tpl->assign('HOSTING_PLANS', '');
        setPageMessage(tr('No hosting plan available.'), 'static_info');
        return;
    }

    $tpl->assign([
        'TR_ID'     => tr('Id'),
        'TR_NAME'   => tr('Name'),
        'TR_STATUS' => tr('Status'),
        'TR_EDIT'   => tr('Edit'),
        'TR_ACTION' => tr('Actions'),
        'TR_DELETE' => tr('Delete')
    ]);

    Registry::get('iMSCP_Application')->getEventsManager()->registerListener(Events::onGetJsTranslations, function (Event $e) {
        $translations = $e->getParam('translations');
        $translations['core']['hp_delete_confirmation'] = tr('Are you sure you want to delete this hosting plan?');
    });

    while ($row = $stmt->fetch()) {
        $tpl->assign([
            'ID'     => $row['id'],
            'NAME'   => toHtml($row['name']),
            'STATUS' => $row['status'] ? tr('Available') : tr('Unavailable'),
        ]);
        $tpl->parse('HOSTING_PLAN', '.hosting_plan');
    }
}

require 'imscp-lib.php';

checkLogin('reseller');
Registry::get('iMSCP_Application')->getEventsManager()->dispatch(iMSCP_Events::onResellerScriptStart);

$tpl = new TemplateEngine();
$tpl->define([
    'layout'        => 'shared/layouts/ui.tpl',
    'page'          => 'reseller/hosting_plan.tpl',
    'page_message'  => 'layout',
    'hosting_plans' => 'page',
    'hosting_plan'  => 'hosting_plans'
]);
$tpl->assign('TR_PAGE_TITLE', tr('Reseller / Hosting Plans / Overview'));
generateNavigation($tpl);
generatePage($tpl);
generatePageMessage($tpl);
$tpl->parse('LAYOUT_CONTENT', 'page');
Registry::get('iMSCP_Application')->getEventsManager()->dispatch(iMSCP_Events::onResellerScriptEnd, ['templateEngine' => $tpl]);
$tpl->prnt();
unsetMessages();