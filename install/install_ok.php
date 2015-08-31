<?php
/**
 * @copyright Copyright © 2015 Notamedia Ltd.
 * @license MIT
 */

if (!check_bitrix_sessid())
{
    return false;
}

CAdminMessage::ShowNote(GetMessage('NOTA_NICEACCESS_INSTALL_COMPLETE_TITLE'));
echo GetMessage('NOTA_NICEACCESS_INSTALL_COMPLETE_MESSAGE');
?>
<div style="margin-top: 20px;">
    <input onclick="location.href='<?=$APPLICATION->GetCurPage()?>?lang=<?=LANGUAGE_ID?>'" type="submit"
           value="<?=GetMessage('NOTA_NICEACCESS_INSTALL_LINK_BACK_SOLUTIONS')?>"/>
</div>