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
use iMSCP_Registry as Registry;

require 'imscp-lib.php';

checkLogin('admin');
Registry::get('iMSCP_Application')->getEventsManager()->dispatch(iMSCP_Events::onAdminScriptStart);

$tpl = new TemplateEngine();
$tpl->define([
    'layout'       => 'shared/layouts/ui.tpl',
    'page'         => 'admin/software_options.tpl',
    'page_message' => 'layout'
]);
$tpl->assign('TR_PAGE_TITLE', tr('Admin / Settings / Software Options'));

if (isset($_POST['uaction']) && $_POST['uaction'] == 'apply') {
    $error = '';
    $webdepot_xml_url = encodeIdna(strtolower(cleanInput($_POST['webdepot_xml_url'])));
    (strlen($webdepot_xml_url) > 0) ? $use_webdepot = $_POST['use_webdepot'] : $use_webdepot = '0';

    if (strlen($webdepot_xml_url) > 0 && $use_webdepot === '1') {
        $xml_file = @file_get_contents($webdepot_xml_url);
        if (!strpos($xml_file, 'i-MSCP web software repositories list')) {
            setPageMessage(tr("Unable to read xml file for web software."), 'error');
            $error = 1;
        }
    }
    if (!$error) {
        execQuery('UPDATE web_software_options SET use_webdepot = ?, webdepot_xml_url = ?', [
            $use_webdepot, $webdepot_xml_url
        ]);
        setPageMessage(tr("Software installer options successfully updated."), 'success');
    }
}

$stmt = executeQuery('SELECT * FROM web_software_options');
$stmt->rowCount() or showBadRequestErrorPage();
$row = $stmt->fetch();

$tpl->assign([
    'TR_OPTIONS_SOFTWARE'        => tr('Software installer options'),
    'TR_MAIN_OPTIONS'            => tr('Software installer options'),
    'TR_USE_WEBDEPOT'            => tr('Remote Web software repository'),
    'TR_WEBDEPOT_XML_URL'        => tr('XML file URL for the Web software repository'),
    'TR_WEBDEPOT_LAST_UPDATE'    => tr('Last Web software repository update'),
    'USE_WEBDEPOT_SELECTED_OFF'  => (($row['use_webdepot'] == 0) ? ' selected' : ''),
    'USE_WEBDEPOT_SELECTED_ON'   => (($row['use_webdepot'] == 1) ? ' selected' : ''),
    'WEBDEPOT_XML_URL_VALUE'     => $row['webdepot_xml_url'],
    'WEBDEPOT_LAST_UPDATE_VALUE' => ($row['webdepot_last_update'] == "0000-00-00 00:00:00") ? tr('not available') : $row['webdepot_last_update'],
    'TR_APPLY_CHANGES'           => tr('Apply changes'),
    'TR_ENABLED'                 => tr('Enabled'),
    'TR_DISABLED'                => tr('Disabled')
]);
generateNavigation($tpl);
generatePageMessage($tpl);
$tpl->parse('LAYOUT_CONTENT', 'page');
Registry::get('iMSCP_Application')->getEventsManager()->dispatch(iMSCP_Events::onAdminScriptEnd, ['templateEngine' => $tpl]);
$tpl->prnt();
unsetMessages();