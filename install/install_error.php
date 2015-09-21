<?php
/**
 * @copyright Copyright © 2015 Notamedia Ltd.
 * @license MIT
 */

if (!check_bitrix_sessid())
{
    return false;
}

echo GetMessage('NOTA_NICEACCESS_INSTALL_ERROR_MESSAGE');

if($ex = $APPLICATION->GetException())
    echo CAdminMessage::ShowMessage(Array(
        "TYPE" => "ERROR",
        "MESSAGE" => GetMessage("MOD_INST_ERR"),
        "DETAILS" => $ex->GetString(),
        "HTML" => true,
    ));
?>
<div style="margin-top: 20px;">
    <input onclick="location.href='<?=$APPLICATION->GetCurPage()?>?lang=<?=LANGUAGE_ID?>'" type="submit"
           value="<?=GetMessage('NOTA_NICEACCESS_INSTALL_LINK_BACK_SOLUTIONS')?>"/>
</div>