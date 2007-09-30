<?php
/**
 * Message Details plugin - main frame
 *
 * Plugin to view the RFC822 raw message output and the bodystructure of 
 * a message
 *
 * @author Marc Groot Koerkamp
 * @copyright Copyright &copy; 2002 Marc Groot Koerkamp, The Netherlands
 * @copyright Copyright &copy; 2004-2006 The SquirrelMail Project Team
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @version $Id: message_details_main.php 12687 2007-09-15 01:18:09Z pdontthink $
 * @package plugins
 * @subpackage message_details
 */

/**
 * Path for SquirrelMail required files.
 * @ignore
 */
define('SM_PATH','../../');

/* SquirrelMail required files. */
require_once(SM_PATH . 'include/validate.php');

displayHtmlHeader( _("Message Details"), '', FALSE );

sqgetGlobalVar('mailbox', $mailbox, SQ_GET);
sqgetGlobalVar('passed_id', $passed_id, SQ_GET);
if (!sqgetGlobalVar('passed_ent_id', $passed_ent_id, SQ_GET))
    $passed_ent_id = 0;

echo "<frameset rows=\"60, *\" noresize border=\"0\">\n";
echo '<frame src="message_details_top.php?mailbox=' 
    . urlencode($mailbox) .'&amp;passed_id=' . $passed_id
    . '&amp;passed_ent_id=' . $passed_ent_id
    . '" name="top_frame" scrolling="off">';
echo '<frame src="message_details_bottom.php?mailbox=' 
    . urlencode($mailbox) .'&amp;passed_id=' . $passed_id 
    . '&amp;passed_ent_id=' . $passed_ent_id
    . '" name="bottom_frame">';
echo '</frameset>'."\n"."</html>\n";
?>
