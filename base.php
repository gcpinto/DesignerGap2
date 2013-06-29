<?php

date_default_timezone_set('Europe/Lisbon');

require_once('common/utils.php');
//require_once('library/base_facebook.php');
//require_once('library/facebook.php');
require_once('library/bitly.php');
require_once('browser.php');


require_once('data/config.php');
require_once('data/sqlconnection.php');
require_once('data/ICMSdataobject.php');
require_once('data/IDaoObject.php');
require_once('data/IDaoType.php');
require_once('data/daoContent.php');
require_once('data/daoContentmedia.php');
require_once('data/daoContenthistory.php');
require_once('data/daoSource.php');
require_once('data/daoTopsource.php');
require_once('data/daoUser.php');
require_once('data/daoSubscription.php');
require_once('data/daoText.php');
require_once('data/daoSuggestion.php');
require_once('data/daoCategory.php');
require_once('data/daoDomain.php');
require_once('data/daoProfile.php');
require_once('data/daoProfiledomain.php');
require_once('data/daoAdvertiser.php');
require_once('data/daoPreadvertiser.php');
require_once('data/daoPub.php');
require_once('data/daoPubtype.php');
require_once('data/daoFeedpath.php');
//require_once('data/daoFacebook.php');
//require_once('browscap.ini');
//require_once('data/daoLanguage.php');
//require_once('data/daoTranslation.php');



require_once('objects/object.php');
require_once('objects/content.php');
require_once('objects/contenthistory.php');
require_once('objects/contentmedia.php');
require_once('objects/source.php');
require_once('objects/topsource.php');
require_once('objects/user.php');
require_once('objects/subscription.php');
require_once('objects/suggestion.php');
require_once('objects/category.php');
require_once('objects/advertiser.php');
require_once('objects/preadvertiser.php');
require_once('objects/pub.php');
require_once('objects/pubtype.php');
//require_once('objects/language.php');
//require_once('objects/translation.php');
require_once('objects/domain.php');
require_once('objects/profiledomain.php');
require_once('objects/profile.php');
require_once('objects/text.php');
require_once('objects/feedpath.php');
require_once('objects/facebook.php');


require_once('logic/gLogic.php');

if (!ISSET($_SESSION))
{
	session_start();
}

?>