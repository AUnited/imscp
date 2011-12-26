
            <form action="settings_maintenance_mode.php" method="post" name="maintenancemode_frm" id="maintenancemode_frm">
                <table>
					<tr>
						<th colspan="2">{TR_MAINTENANCE_MESSAGE}</th>
					</tr>
                    <tr>
                        <td style="vertical-align: top;">
                            <label for="maintenancemode_message">{TR_MESSAGE}</label>
                        </td>
                        <td><textarea name="maintenancemode_message" id="maintenancemode_message">{MESSAGE_VALUE}</textarea></td>
                    </tr>
                    <tr>
                        <td><label for="maintenancemode">{TR_MAINTENANCEMODE}</label></td>
                        <td>
							<select name="maintenancemode" id="maintenancemode">
                                <option value="0" {SELECTED_OFF}>{TR_DISABLED}</option>
                                <option value="1" {SELECTED_ON}>{TR_ENABLED}</option>
                        	</select>
						</td>
                    </tr>
                </table>
                <div class="buttons">
                    <input name="Submit" type="submit" value="{TR_APPLY_CHANGES}" />
                    <input type="hidden" name="uaction" value="apply" />
                </div>
            </form>
