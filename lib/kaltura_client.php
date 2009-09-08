<?php
/*
This file is part of the Kaltura Collaborative Media Suite which allows users
to do with audio, video, and animation what Wiki platfroms allow them to do with
text.

Copyright (C) 2006-2008 Kaltura Inc.

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU Affero General Public License as
published by the Free Software Foundation, either version 3 of the
License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU Affero General Public License for more details.

You should have received a copy of the GNU Affero General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

/**
Generated at 03/08 10:01:02
**/

require_once("kaltura_client_base.php");

class KalturaEntry
{
	var $name;
	var $tags;
	var $type;
	var $mediaType;
	var $source;
	var $sourceId;
	var $sourceLink;
	var $licenseType;
	var $credit;
	var $groupId;
	var $partnerData;
	var $conversionQuality;
	var $permissions;
	var $dataContent;
	var $desiredVersion;
	var $url;
	var $thumbUrl;
	var $filename;
	var $realFilename;
	var $indexedCustomData1;
	var $thumbOffset;
	var $mediaId;
}

class KalturaKShow
{
	var $name;
	var $description;
	var $tags;
	var $indexedCustomData3;
	var $groupId;
	var $permissions;
	var $partnerData;
	var $allowQuickEdit;
}

class KalturaModeration
{
	var $comments;
	var $objectType;
	var $objectId;
}

class KalturaUser
{
	var $screenName;
	var $fullName;
	var $email;
	var $dateOfBirth;
	var $aboutMe;
	var $tags;
	var $gender;
	var $country;
	var $state;
	var $city;
	var $zip;
	var $urlList;
	var $networkHighschool;
	var $networkCollege;
	var $partnerData;
}

class KalturaWidget
{
	var $kshowId;
	var $entryId;
	var $sourceWidgetId;
	var $uiConfId;
	var $customData;
	var $partnerData;
	var $securityType;
}

class KalturaPuserKuser
{
}

class KalturaUiConf
{
	var $name;
}

define("KalturaEntryFilter_ORDER_BY_CREATED_AT_ASC","+created_at");
define("KalturaEntryFilter_ORDER_BY_CREATED_AT_DESC","-created_at");
define("KalturaEntryFilter_ORDER_BY_VIEWS_ASC","+views");
define("KalturaEntryFilter_ORDER_BY_VIEWS_DESC","-views");
define("KalturaEntryFilter_ORDER_BY_ID_ASC","+id");
define("KalturaEntryFilter_ORDER_BY_ID_DESC","-id");

class KalturaEntryFilter
{
	var $equalUserId;
	var $equalKshowId;
	var $equalType;
	var $inType;
	var $equalMediaType;
	var $inMediaType;
	var $equalIndexedCustomData;
	var $inIndexedCustomData;
	var $likeName;
	var $equalGroupId;
	var $greaterThanOrEqualViews;
	var $greaterThanOrEqualCreatedAt;
	var $lessThanOrEqualCreatedAt;
	var $inPartnerId;
	var $equalPartnerId;
	var $orderBy;
}

define("KalturaKShowFilter_ORDER_BY_CREATED_AT_ASC","+created_at");
define("KalturaKShowFilter_ORDER_BY_CREATED_AT_DESC","-created_at");
define("KalturaKShowFilter_ORDER_BY_VIEWS_ASC","+views");
define("KalturaKShowFilter_ORDER_BY_VIEWS_DESC","-views");
define("KalturaKShowFilter_ORDER_BY_ID_ASC","+id");
define("KalturaKShowFilter_ORDER_BY_ID_DESC","-id");

class KalturaKShowFilter
{
	var $likeName;
	var $greaterThanOrEqualViews;
	var $equalType;
	var $equalProducerId;
	var $greaterThanOrEqualCreatedAt;
	var $lessThanOrEqualCreatedAt;
	var $orderBy;
}

define("KalturaModerationFilter_ORDER_BY_ID_ASC","+id");
define("KalturaModerationFilter_ORDER_BY_ID_DESC","-id");

class KalturaModerationFilter
{
	var $equalId;
	var $equalPuserId;
	var $equalStatus;
	var $likeComments;
	var $equalObjectId;
	var $equalObjectType;
	var $equalGroupId;
	var $orderBy;
}

define("KalturaNotificationFilter_ORDER_BY_ID_ASC","+id");
define("KalturaNotificationFilter_ORDER_BY_ID_DESC","-id");

class KalturaNotificationFilter
{
	var $equalId;
	var $greaterThanOrEqualId;
	var $equalStatus;
	var $equalType;
	var $orderBy;
}

class KalturaNotification
{
	var $id;
	var $status;
	var $notificationResult;
}

class KalturaPartner
{
	var $name;
	var $url1;
	var $url2;
	var $appearInSearch;
	var $adminName;
	var $adminEmail;
	var $description;
	var $commercialUse;
	var $type;
}

class KalturaClient extends KalturaClientBase
{
	function KalturaClient($conf)
	{
		KalturaClientBase::KalturaClientBase($conf);
	}

	function addDvdEntry($kalturaSessionUser, $dvdEntry)
	{
		$params = array();
		$this->addOptionalParam($params, "dvdEntry_name", $dvdEntry->name);
		$this->addOptionalParam($params, "dvdEntry_tags", $dvdEntry->tags);
		$this->addOptionalParam($params, "dvdEntry_type", $dvdEntry->type);
		$this->addOptionalParam($params, "dvdEntry_mediaType", $dvdEntry->mediaType);
		$this->addOptionalParam($params, "dvdEntry_source", $dvdEntry->source);
		$this->addOptionalParam($params, "dvdEntry_sourceId", $dvdEntry->sourceId);
		$this->addOptionalParam($params, "dvdEntry_sourceLink", $dvdEntry->sourceLink);
		$this->addOptionalParam($params, "dvdEntry_licenseType", $dvdEntry->licenseType);
		$this->addOptionalParam($params, "dvdEntry_credit", $dvdEntry->credit);
		$this->addOptionalParam($params, "dvdEntry_groupId", $dvdEntry->groupId);
		$this->addOptionalParam($params, "dvdEntry_partnerData", $dvdEntry->partnerData);
		$this->addOptionalParam($params, "dvdEntry_conversionQuality", $dvdEntry->conversionQuality);
		$this->addOptionalParam($params, "dvdEntry_permissions", $dvdEntry->permissions);
		$this->addOptionalParam($params, "dvdEntry_dataContent", $dvdEntry->dataContent);
		$this->addOptionalParam($params, "dvdEntry_desiredVersion", $dvdEntry->desiredVersion);
		$this->addOptionalParam($params, "dvdEntry_url", $dvdEntry->url);
		$this->addOptionalParam($params, "dvdEntry_thumbUrl", $dvdEntry->thumbUrl);
		$this->addOptionalParam($params, "dvdEntry_filename", $dvdEntry->filename);
		$this->addOptionalParam($params, "dvdEntry_realFilename", $dvdEntry->realFilename);
		$this->addOptionalParam($params, "dvdEntry_indexedCustomData1", $dvdEntry->indexedCustomData1);
		$this->addOptionalParam($params, "dvdEntry_thumbOffset", $dvdEntry->thumbOffset);
		$this->addOptionalParam($params, "dvdEntry_mediaId", $dvdEntry->mediaId);

		$result = $this->hit("adddvdentry", $kalturaSessionUser, $params);
		return $result;
	}

	function addEntry($kalturaSessionUser, $kshowId, $entry, $uid = null)
	{
		$params = array();
		$params["kshow_id"] = $kshowId;
		$this->addOptionalParam($params, "entry_name", $entry->name);
		$this->addOptionalParam($params, "entry_tags", $entry->tags);
		$this->addOptionalParam($params, "entry_type", $entry->type);
		$this->addOptionalParam($params, "entry_mediaType", $entry->mediaType);
		$this->addOptionalParam($params, "entry_source", $entry->source);
		$this->addOptionalParam($params, "entry_sourceId", $entry->sourceId);
		$this->addOptionalParam($params, "entry_sourceLink", $entry->sourceLink);
		$this->addOptionalParam($params, "entry_licenseType", $entry->licenseType);
		$this->addOptionalParam($params, "entry_credit", $entry->credit);
		$this->addOptionalParam($params, "entry_groupId", $entry->groupId);
		$this->addOptionalParam($params, "entry_partnerData", $entry->partnerData);
		$this->addOptionalParam($params, "entry_conversionQuality", $entry->conversionQuality);
		$this->addOptionalParam($params, "entry_permissions", $entry->permissions);
		$this->addOptionalParam($params, "entry_dataContent", $entry->dataContent);
		$this->addOptionalParam($params, "entry_desiredVersion", $entry->desiredVersion);
		$this->addOptionalParam($params, "entry_url", $entry->url);
		$this->addOptionalParam($params, "entry_thumbUrl", $entry->thumbUrl);
		$this->addOptionalParam($params, "entry_filename", $entry->filename);
		$this->addOptionalParam($params, "entry_realFilename", $entry->realFilename);
		$this->addOptionalParam($params, "entry_indexedCustomData1", $entry->indexedCustomData1);
		$this->addOptionalParam($params, "entry_thumbOffset", $entry->thumbOffset);
		$this->addOptionalParam($params, "entry_mediaId", $entry->mediaId);
		$this->addOptionalParam($params, "uid", $uid);

		$result = $this->hit("addentry", $kalturaSessionUser, $params);
		return $result;
	}

	function addKShow($kalturaSessionUser, $kshow, $detailed = null, $allowDuplicateNames = null)
	{
		$params = array();
		$this->addOptionalParam($params, "kshow_name", $kshow->name);
		$this->addOptionalParam($params, "kshow_description", $kshow->description);
		$this->addOptionalParam($params, "kshow_tags", $kshow->tags);
		$this->addOptionalParam($params, "kshow_indexedCustomData3", $kshow->indexedCustomData3);
		$this->addOptionalParam($params, "kshow_groupId", $kshow->groupId);
		$this->addOptionalParam($params, "kshow_permissions", $kshow->permissions);
		$this->addOptionalParam($params, "kshow_partnerData", $kshow->partnerData);
		$this->addOptionalParam($params, "kshow_allowQuickEdit", $kshow->allowQuickEdit);
		$this->addOptionalParam($params, "detailed", $detailed);
		$this->addOptionalParam($params, "allow_duplicate_names", $allowDuplicateNames);

		$result = $this->hit("addkshow", $kalturaSessionUser, $params);
		return $result;
	}

	function addModeration($kalturaSessionUser, $moderation)
	{
		$params = array();
		$this->addOptionalParam($params, "moderation_comments", $moderation->comments);
		$this->addOptionalParam($params, "moderation_objectType", $moderation->objectType);
		$this->addOptionalParam($params, "moderation_objectId", $moderation->objectId);

		$result = $this->hit("addmoderation", $kalturaSessionUser, $params);
		return $result;
	}

	function addPartnerEntry($kalturaSessionUser, $kshowId, $entry, $uid = null)
	{
		$params = array();
		$params["kshow_id"] = $kshowId;
		$this->addOptionalParam($params, "entry_name", $entry->name);
		$this->addOptionalParam($params, "entry_tags", $entry->tags);
		$this->addOptionalParam($params, "entry_type", $entry->type);
		$this->addOptionalParam($params, "entry_mediaType", $entry->mediaType);
		$this->addOptionalParam($params, "entry_source", $entry->source);
		$this->addOptionalParam($params, "entry_sourceId", $entry->sourceId);
		$this->addOptionalParam($params, "entry_sourceLink", $entry->sourceLink);
		$this->addOptionalParam($params, "entry_licenseType", $entry->licenseType);
		$this->addOptionalParam($params, "entry_credit", $entry->credit);
		$this->addOptionalParam($params, "entry_groupId", $entry->groupId);
		$this->addOptionalParam($params, "entry_partnerData", $entry->partnerData);
		$this->addOptionalParam($params, "entry_conversionQuality", $entry->conversionQuality);
		$this->addOptionalParam($params, "entry_permissions", $entry->permissions);
		$this->addOptionalParam($params, "entry_dataContent", $entry->dataContent);
		$this->addOptionalParam($params, "entry_desiredVersion", $entry->desiredVersion);
		$this->addOptionalParam($params, "entry_url", $entry->url);
		$this->addOptionalParam($params, "entry_thumbUrl", $entry->thumbUrl);
		$this->addOptionalParam($params, "entry_filename", $entry->filename);
		$this->addOptionalParam($params, "entry_realFilename", $entry->realFilename);
		$this->addOptionalParam($params, "entry_indexedCustomData1", $entry->indexedCustomData1);
		$this->addOptionalParam($params, "entry_thumbOffset", $entry->thumbOffset);
		$this->addOptionalParam($params, "entry_mediaId", $entry->mediaId);
		$this->addOptionalParam($params, "uid", $uid);

		$result = $this->hit("addpartnerentry", $kalturaSessionUser, $params);
		return $result;
	}

	function addUser($kalturaSessionUser, $userId, $user)
	{
		$params = array();
		$params["user_id"] = $userId;
		$this->addOptionalParam($params, "user_screenName", $user->screenName);
		$this->addOptionalParam($params, "user_fullName", $user->fullName);
		$this->addOptionalParam($params, "user_email", $user->email);
		$this->addOptionalParam($params, "user_dateOfBirth", $user->dateOfBirth);
		$this->addOptionalParam($params, "user_aboutMe", $user->aboutMe);
		$this->addOptionalParam($params, "user_tags", $user->tags);
		$this->addOptionalParam($params, "user_gender", $user->gender);
		$this->addOptionalParam($params, "user_country", $user->country);
		$this->addOptionalParam($params, "user_state", $user->state);
		$this->addOptionalParam($params, "user_city", $user->city);
		$this->addOptionalParam($params, "user_zip", $user->zip);
		$this->addOptionalParam($params, "user_urlList", $user->urlList);
		$this->addOptionalParam($params, "user_networkHighschool", $user->networkHighschool);
		$this->addOptionalParam($params, "user_networkCollege", $user->networkCollege);
		$this->addOptionalParam($params, "user_partnerData", $user->partnerData);

		$result = $this->hit("adduser", $kalturaSessionUser, $params);
		return $result;
	}

	function addWidget($kalturaSessionUser, $widget)
	{
		$params = array();
		$this->addOptionalParam($params, "widget_kshowId", $widget->kshowId);
		$this->addOptionalParam($params, "widget_entryId", $widget->entryId);
		$this->addOptionalParam($params, "widget_sourceWidgetId", $widget->sourceWidgetId);
		$this->addOptionalParam($params, "widget_uiConfId", $widget->uiConfId);
		$this->addOptionalParam($params, "widget_customData", $widget->customData);
		$this->addOptionalParam($params, "widget_partnerData", $widget->partnerData);
		$this->addOptionalParam($params, "widget_securityType", $widget->securityType);

		$result = $this->hit("addwidget", $kalturaSessionUser, $params);
		return $result;
	}

	function appendEntryToRoughcut($kalturaSessionUser, $entryId, $kshowId, $showEntryId = null)
	{
		$params = array();
		$params["entry_id"] = $entryId;
		$params["kshow_id"] = $kshowId;
		$this->addOptionalParam($params, "show_entry_id", $showEntryId);

		$result = $this->hit("appendentrytoroughcut", $kalturaSessionUser, $params);
		return $result;
	}

	function checkNotifications($kalturaSessionUser, $notificationIds, $separator = ",", $detailed = null)
	{
		$params = array();
		$params["notification_ids"] = $notificationIds;
		$this->addOptionalParam($params, "separator", $separator);
		$this->addOptionalParam($params, "detailed", $detailed);

		$result = $this->hit("checknotifications", $kalturaSessionUser, $params);
		return $result;
	}

	function cloneKShow($kalturaSessionUser, $kshowId, $detailed = null)
	{
		$params = array();
		$params["kshow_id"] = $kshowId;
		$this->addOptionalParam($params, "detailed", $detailed);

		$result = $this->hit("clonekshow", $kalturaSessionUser, $params);
		return $result;
	}

	function collectStats($kalturaSessionUser, $objType, $objId, $command, $value, $extraInfo, $kshowId = null)
	{
		$params = array();
		$params["obj_type"] = $objType;
		$params["obj_id"] = $objId;
		$params["command"] = $command;
		$params["value"] = $value;
		$params["extra_info"] = $extraInfo;
		$this->addOptionalParam($params, "kshow_id", $kshowId);

		$result = $this->hit("collectstats", $kalturaSessionUser, $params);
		return $result;
	}

	function deleteEntry($kalturaSessionUser, $entryId, $kshowId = null)
	{
		$params = array();
		$params["entry_id"] = $entryId;
		$this->addOptionalParam($params, "kshow_id", $kshowId);

		$result = $this->hit("deleteentry", $kalturaSessionUser, $params);
		return $result;
	}

	function deleteKShow($kalturaSessionUser, $kshowId)
	{
		$params = array();
		$params["kshow_id"] = $kshowId;

		$result = $this->hit("deletekshow", $kalturaSessionUser, $params);
		return $result;
	}

	function deleteUser($kalturaSessionUser, $userId)
	{
		$params = array();
		$params["user_id"] = $userId;

		$result = $this->hit("deleteuser", $kalturaSessionUser, $params);
		return $result;
	}

	function getAllEntries($kalturaSessionUser, $entryId, $kshowId, $listType = null, $version = null, $entryType = null, $disableRoughcutEntryData = null)
	{
		$params = array();
		$params["entry_id"] = $entryId;
		$params["kshow_id"] = $kshowId;
		$this->addOptionalParam($params, "list_type", $listType);
		$this->addOptionalParam($params, "version", $version);
		$this->addOptionalParam($params, "entry_type", $entryType);
		$this->addOptionalParam($params, "disable_roughcut_entry_data", $disableRoughcutEntryData);

		$result = $this->hit("getallentries", $kalturaSessionUser, $params);
		return $result;
	}

	function getDvdEntry($kalturaSessionUser, $dvdEntryId, $detailed = null)
	{
		$params = array();
		$params["dvdEntry_id"] = $dvdEntryId;
		$this->addOptionalParam($params, "detailed", $detailed);

		$result = $this->hit("getdvdentry", $kalturaSessionUser, $params);
		return $result;
	}

	function getEntries($kalturaSessionUser, $entryIds, $separator = ",", $detailed = null)
	{
		$params = array();
		$params["entry_ids"] = $entryIds;
		$this->addOptionalParam($params, "separator", $separator);
		$this->addOptionalParam($params, "detailed", $detailed);

		$result = $this->hit("getentries", $kalturaSessionUser, $params);
		return $result;
	}

	function getEntry($kalturaSessionUser, $entryId, $detailed = null, $version = null)
	{
		$params = array();
		$params["entry_id"] = $entryId;
		$this->addOptionalParam($params, "detailed", $detailed);
		$this->addOptionalParam($params, "version", $version);

		$result = $this->hit("getentry", $kalturaSessionUser, $params);
		return $result;
	}

	function getKShow($kalturaSessionUser, $kshowId, $detailed = null)
	{
		$params = array();
		$params["kshow_id"] = $kshowId;
		$this->addOptionalParam($params, "detailed", $detailed);

		$result = $this->hit("getkshow", $kalturaSessionUser, $params);
		return $result;
	}

	function getLastVersionsInfo($kalturaSessionUser, $kshowId)
	{
		$params = array();
		$params["kshow_id"] = $kshowId;

		$result = $this->hit("getlastversionsinfo", $kalturaSessionUser, $params);
		return $result;
	}

	function getMetaDataAction($kalturaSessionUser, $entryId, $kshowId, $version)
	{
		$params = array();
		$params["entry_id"] = $entryId;
		$params["kshow_id"] = $kshowId;
		$params["version"] = $version;

		$result = $this->hit("getmetadata", $kalturaSessionUser, $params);
		return $result;
	}

	function getPartner($kalturaSessionUser, $partnerAdminEmail, $cmsPassword, $partnerId)
	{
		$params = array();
		$params["partner_adminEmail"] = $partnerAdminEmail;
		$params["cms_password"] = $cmsPassword;
		$params["partner_id"] = $partnerId;

		$result = $this->hit("getpartner", $kalturaSessionUser, $params);
		return $result;
	}

	function getThumbnail($kalturaSessionUser, $filename)
	{
		$params = array();
		$params["filename"] = $filename;

		$result = $this->hit("getthumbnail", $kalturaSessionUser, $params);
		return $result;
	}

	function getUIConf($kalturaSessionUser, $uiConfId, $detailed = null)
	{
		$params = array();
		$params["ui_conf_id"] = $uiConfId;
		$this->addOptionalParam($params, "detailed", $detailed);

		$result = $this->hit("getuiconf", $kalturaSessionUser, $params);
		return $result;
	}

	function getUser($kalturaSessionUser, $userId, $detailed = null)
	{
		$params = array();
		$params["user_id"] = $userId;
		$this->addOptionalParam($params, "detailed", $detailed);

		$result = $this->hit("getuser", $kalturaSessionUser, $params);
		return $result;
	}

	function getWidget($kalturaSessionUser, $widgetId, $detailed = null)
	{
		$params = array();
		$params["widget_id"] = $widgetId;
		$this->addOptionalParam($params, "detailed", $detailed);

		$result = $this->hit("getwidget", $kalturaSessionUser, $params);
		return $result;
	}

	function handleModeration($kalturaSessionUser, $moderationId, $moderationStatus)
	{
		$params = array();
		$params["moderation_id"] = $moderationId;
		$params["moderation_status"] = $moderationStatus;

		$result = $this->hit("handlemoderation", $kalturaSessionUser, $params);
		return $result;
	}

	function listDvdEntries($kalturaSessionUser, $filter, $detailed = null, $pageSize = 10, $page = 1, $useFilterPuserId = null)
	{
		$params = array();
		$this->addOptionalParam($params, "filter__eq_user_id", $filter->equalUserId);
		$this->addOptionalParam($params, "filter__eq_kshow_id", $filter->equalKshowId);
		$this->addOptionalParam($params, "filter__eq_type", $filter->equalType);
		$this->addOptionalParam($params, "filter__in_type", $filter->inType);
		$this->addOptionalParam($params, "filter__eq_media_type", $filter->equalMediaType);
		$this->addOptionalParam($params, "filter__in_media_type", $filter->inMediaType);
		$this->addOptionalParam($params, "filter__eq_indexed_custom_data_1", $filter->equalIndexedCustomData);
		$this->addOptionalParam($params, "filter__in_indexed_custom_data_1", $filter->inIndexedCustomData);
		$this->addOptionalParam($params, "filter__like_name", $filter->likeName);
		$this->addOptionalParam($params, "filter__eq_group_id", $filter->equalGroupId);
		$this->addOptionalParam($params, "filter__gte_views", $filter->greaterThanOrEqualViews);
		$this->addOptionalParam($params, "filter__gte_created_at", $filter->greaterThanOrEqualCreatedAt);
		$this->addOptionalParam($params, "filter__lte_created_at", $filter->lessThanOrEqualCreatedAt);
		$this->addOptionalParam($params, "filter__in_partner_id", $filter->inPartnerId);
		$this->addOptionalParam($params, "filter__eq_partner_id", $filter->equalPartnerId);
		$this->addOptionalParam($params, "filter__order_by", $filter->orderBy);
		$this->addOptionalParam($params, "detailed", $detailed);
		$this->addOptionalParam($params, "page_size", $pageSize);
		$this->addOptionalParam($params, "page", $page);
		$this->addOptionalParam($params, "use_filter_puser_id", $useFilterPuserId);

		$result = $this->hit("listdvdentries", $kalturaSessionUser, $params);
		return $result;
	}

	function listEntries($kalturaSessionUser, $filter, $detailed = null, $pageSize = 10, $page = 1, $useFilterPuserId = null)
	{
		$params = array();
		$this->addOptionalParam($params, "filter__eq_user_id", $filter->equalUserId);
		$this->addOptionalParam($params, "filter__eq_kshow_id", $filter->equalKshowId);
		$this->addOptionalParam($params, "filter__eq_type", $filter->equalType);
		$this->addOptionalParam($params, "filter__in_type", $filter->inType);
		$this->addOptionalParam($params, "filter__eq_media_type", $filter->equalMediaType);
		$this->addOptionalParam($params, "filter__in_media_type", $filter->inMediaType);
		$this->addOptionalParam($params, "filter__eq_indexed_custom_data_1", $filter->equalIndexedCustomData);
		$this->addOptionalParam($params, "filter__in_indexed_custom_data_1", $filter->inIndexedCustomData);
		$this->addOptionalParam($params, "filter__like_name", $filter->likeName);
		$this->addOptionalParam($params, "filter__eq_group_id", $filter->equalGroupId);
		$this->addOptionalParam($params, "filter__gte_views", $filter->greaterThanOrEqualViews);
		$this->addOptionalParam($params, "filter__gte_created_at", $filter->greaterThanOrEqualCreatedAt);
		$this->addOptionalParam($params, "filter__lte_created_at", $filter->lessThanOrEqualCreatedAt);
		$this->addOptionalParam($params, "filter__in_partner_id", $filter->inPartnerId);
		$this->addOptionalParam($params, "filter__eq_partner_id", $filter->equalPartnerId);
		$this->addOptionalParam($params, "filter__order_by", $filter->orderBy);
		$this->addOptionalParam($params, "detailed", $detailed);
		$this->addOptionalParam($params, "page_size", $pageSize);
		$this->addOptionalParam($params, "page", $page);
		$this->addOptionalParam($params, "use_filter_puser_id", $useFilterPuserId);

		$result = $this->hit("listentries", $kalturaSessionUser, $params);
		return $result;
	}

	function listKShows($kalturaSessionUser, $filter, $detailed = null, $pageSize = 10, $page = 1, $useFilterPuserId = null)
	{
		$params = array();
		$this->addOptionalParam($params, "filter__like_name", $filter->likeName);
		$this->addOptionalParam($params, "filter__gte_views", $filter->greaterThanOrEqualViews);
		$this->addOptionalParam($params, "filter__eq_type", $filter->equalType);
		$this->addOptionalParam($params, "filter__eq_producer_id", $filter->equalProducerId);
		$this->addOptionalParam($params, "filter__gte_created_at", $filter->greaterThanOrEqualCreatedAt);
		$this->addOptionalParam($params, "filter__lte_created_at", $filter->lessThanOrEqualCreatedAt);
		$this->addOptionalParam($params, "filter__order_by", $filter->orderBy);
		$this->addOptionalParam($params, "detailed", $detailed);
		$this->addOptionalParam($params, "page_size", $pageSize);
		$this->addOptionalParam($params, "page", $page);
		$this->addOptionalParam($params, "use_filter_puser_id", $useFilterPuserId);

		$result = $this->hit("listkshows", $kalturaSessionUser, $params);
		return $result;
	}

	function listModerations($kalturaSessionUser, $filter, $detailed = null, $pageSize = 10, $page = 1)
	{
		$params = array();
		$this->addOptionalParam($params, "filter__eq_id", $filter->equalId);
		$this->addOptionalParam($params, "filter__eq_puser_id", $filter->equalPuserId);
		$this->addOptionalParam($params, "filter__eq_status", $filter->equalStatus);
		$this->addOptionalParam($params, "filter__like_comments", $filter->likeComments);
		$this->addOptionalParam($params, "filter__eq_object_id", $filter->equalObjectId);
		$this->addOptionalParam($params, "filter__eq_object_type", $filter->equalObjectType);
		$this->addOptionalParam($params, "filter__eq_group_id", $filter->equalGroupId);
		$this->addOptionalParam($params, "filter__order_by", $filter->orderBy);
		$this->addOptionalParam($params, "detailed", $detailed);
		$this->addOptionalParam($params, "page_size", $pageSize);
		$this->addOptionalParam($params, "page", $page);

		$result = $this->hit("listmoderations", $kalturaSessionUser, $params);
		return $result;
	}

	function listMyDvdEntries($kalturaSessionUser, $filter, $detailed = null, $pageSize = 10, $page = 1, $useFilterPuserId = null)
	{
		$params = array();
		$this->addOptionalParam($params, "filter__eq_user_id", $filter->equalUserId);
		$this->addOptionalParam($params, "filter__eq_kshow_id", $filter->equalKshowId);
		$this->addOptionalParam($params, "filter__eq_type", $filter->equalType);
		$this->addOptionalParam($params, "filter__in_type", $filter->inType);
		$this->addOptionalParam($params, "filter__eq_media_type", $filter->equalMediaType);
		$this->addOptionalParam($params, "filter__in_media_type", $filter->inMediaType);
		$this->addOptionalParam($params, "filter__eq_indexed_custom_data_1", $filter->equalIndexedCustomData);
		$this->addOptionalParam($params, "filter__in_indexed_custom_data_1", $filter->inIndexedCustomData);
		$this->addOptionalParam($params, "filter__like_name", $filter->likeName);
		$this->addOptionalParam($params, "filter__eq_group_id", $filter->equalGroupId);
		$this->addOptionalParam($params, "filter__gte_views", $filter->greaterThanOrEqualViews);
		$this->addOptionalParam($params, "filter__gte_created_at", $filter->greaterThanOrEqualCreatedAt);
		$this->addOptionalParam($params, "filter__lte_created_at", $filter->lessThanOrEqualCreatedAt);
		$this->addOptionalParam($params, "filter__in_partner_id", $filter->inPartnerId);
		$this->addOptionalParam($params, "filter__eq_partner_id", $filter->equalPartnerId);
		$this->addOptionalParam($params, "filter__order_by", $filter->orderBy);
		$this->addOptionalParam($params, "detailed", $detailed);
		$this->addOptionalParam($params, "page_size", $pageSize);
		$this->addOptionalParam($params, "page", $page);
		$this->addOptionalParam($params, "use_filter_puser_id", $useFilterPuserId);

		$result = $this->hit("listmydvdentries", $kalturaSessionUser, $params);
		return $result;
	}

	function listMyEntries($kalturaSessionUser, $filter, $detailed = null, $pageSize = 10, $page = 1, $useFilterPuserId = null)
	{
		$params = array();
		$this->addOptionalParam($params, "filter__eq_user_id", $filter->equalUserId);
		$this->addOptionalParam($params, "filter__eq_kshow_id", $filter->equalKshowId);
		$this->addOptionalParam($params, "filter__eq_type", $filter->equalType);
		$this->addOptionalParam($params, "filter__in_type", $filter->inType);
		$this->addOptionalParam($params, "filter__eq_media_type", $filter->equalMediaType);
		$this->addOptionalParam($params, "filter__in_media_type", $filter->inMediaType);
		$this->addOptionalParam($params, "filter__eq_indexed_custom_data_1", $filter->equalIndexedCustomData);
		$this->addOptionalParam($params, "filter__in_indexed_custom_data_1", $filter->inIndexedCustomData);
		$this->addOptionalParam($params, "filter__like_name", $filter->likeName);
		$this->addOptionalParam($params, "filter__eq_group_id", $filter->equalGroupId);
		$this->addOptionalParam($params, "filter__gte_views", $filter->greaterThanOrEqualViews);
		$this->addOptionalParam($params, "filter__gte_created_at", $filter->greaterThanOrEqualCreatedAt);
		$this->addOptionalParam($params, "filter__lte_created_at", $filter->lessThanOrEqualCreatedAt);
		$this->addOptionalParam($params, "filter__in_partner_id", $filter->inPartnerId);
		$this->addOptionalParam($params, "filter__eq_partner_id", $filter->equalPartnerId);
		$this->addOptionalParam($params, "filter__order_by", $filter->orderBy);
		$this->addOptionalParam($params, "detailed", $detailed);
		$this->addOptionalParam($params, "page_size", $pageSize);
		$this->addOptionalParam($params, "page", $page);
		$this->addOptionalParam($params, "use_filter_puser_id", $useFilterPuserId);

		$result = $this->hit("listmyentries", $kalturaSessionUser, $params);
		return $result;
	}

	function listMyKShows($kalturaSessionUser, $filter, $detailed = null, $pageSize = 10, $page = 1, $useFilterPuserId = null)
	{
		$params = array();
		$this->addOptionalParam($params, "filter__like_name", $filter->likeName);
		$this->addOptionalParam($params, "filter__gte_views", $filter->greaterThanOrEqualViews);
		$this->addOptionalParam($params, "filter__eq_type", $filter->equalType);
		$this->addOptionalParam($params, "filter__eq_producer_id", $filter->equalProducerId);
		$this->addOptionalParam($params, "filter__gte_created_at", $filter->greaterThanOrEqualCreatedAt);
		$this->addOptionalParam($params, "filter__lte_created_at", $filter->lessThanOrEqualCreatedAt);
		$this->addOptionalParam($params, "filter__order_by", $filter->orderBy);
		$this->addOptionalParam($params, "detailed", $detailed);
		$this->addOptionalParam($params, "page_size", $pageSize);
		$this->addOptionalParam($params, "page", $page);
		$this->addOptionalParam($params, "use_filter_puser_id", $useFilterPuserId);

		$result = $this->hit("listmykshows", $kalturaSessionUser, $params);
		return $result;
	}

	function listNotifications($kalturaSessionUser, $filter, $pageSize = 10, $page = 1)
	{
		$params = array();
		$this->addOptionalParam($params, "filter__eq_id", $filter->equalId);
		$this->addOptionalParam($params, "filter__gte_id", $filter->greaterThanOrEqualId);
		$this->addOptionalParam($params, "filter__eq_status", $filter->equalStatus);
		$this->addOptionalParam($params, "filter__eq_type", $filter->equalType);
		$this->addOptionalParam($params, "filter__order_by", $filter->orderBy);
		$this->addOptionalParam($params, "page_size", $pageSize);
		$this->addOptionalParam($params, "page", $page);

		$result = $this->hit("listnotifications", $kalturaSessionUser, $params);
		return $result;
	}

	function listPartnerEntries($kalturaSessionUser, $filter, $detailed = null, $pageSize = 10, $page = 1, $useFilterPuserId = null)
	{
		$params = array();
		$this->addOptionalParam($params, "filter__eq_user_id", $filter->equalUserId);
		$this->addOptionalParam($params, "filter__eq_kshow_id", $filter->equalKshowId);
		$this->addOptionalParam($params, "filter__eq_type", $filter->equalType);
		$this->addOptionalParam($params, "filter__in_type", $filter->inType);
		$this->addOptionalParam($params, "filter__eq_media_type", $filter->equalMediaType);
		$this->addOptionalParam($params, "filter__in_media_type", $filter->inMediaType);
		$this->addOptionalParam($params, "filter__eq_indexed_custom_data_1", $filter->equalIndexedCustomData);
		$this->addOptionalParam($params, "filter__in_indexed_custom_data_1", $filter->inIndexedCustomData);
		$this->addOptionalParam($params, "filter__like_name", $filter->likeName);
		$this->addOptionalParam($params, "filter__eq_group_id", $filter->equalGroupId);
		$this->addOptionalParam($params, "filter__gte_views", $filter->greaterThanOrEqualViews);
		$this->addOptionalParam($params, "filter__gte_created_at", $filter->greaterThanOrEqualCreatedAt);
		$this->addOptionalParam($params, "filter__lte_created_at", $filter->lessThanOrEqualCreatedAt);
		$this->addOptionalParam($params, "filter__in_partner_id", $filter->inPartnerId);
		$this->addOptionalParam($params, "filter__eq_partner_id", $filter->equalPartnerId);
		$this->addOptionalParam($params, "filter__order_by", $filter->orderBy);
		$this->addOptionalParam($params, "detailed", $detailed);
		$this->addOptionalParam($params, "page_size", $pageSize);
		$this->addOptionalParam($params, "page", $page);
		$this->addOptionalParam($params, "use_filter_puser_id", $useFilterPuserId);

		$result = $this->hit("listpartnerentries", $kalturaSessionUser, $params);
		return $result;
	}

	function rankKShow($kalturaSessionUser, $kshowId, $rank, $pageSize = 10, $page = 1)
	{
		$params = array();
		$params["kshow_id"] = $kshowId;
		$params["rank"] = $rank;
		$this->addOptionalParam($params, "page_size", $pageSize);
		$this->addOptionalParam($params, "page", $page);

		$result = $this->hit("rankkshow", $kalturaSessionUser, $params);
		return $result;
	}

	function registerPartner($kalturaSessionUser, $partner, $cmsPassword = null)
	{
		$params = array();
		$this->addOptionalParam($params, "partner_name", $partner->name);
		$this->addOptionalParam($params, "partner_url1", $partner->url1);
		$this->addOptionalParam($params, "partner_url2", $partner->url2);
		$this->addOptionalParam($params, "partner_appearInSearch", $partner->appearInSearch);
		$this->addOptionalParam($params, "partner_adminName", $partner->adminName);
		$this->addOptionalParam($params, "partner_adminEmail", $partner->adminEmail);
		$this->addOptionalParam($params, "partner_description", $partner->description);
		$this->addOptionalParam($params, "partner_commercialUse", $partner->commercialUse);
		$this->addOptionalParam($params, "partner_type", $partner->type);
		$this->addOptionalParam($params, "cms_password", $cmsPassword);

		$result = $this->hit("registerpartner", $kalturaSessionUser, $params);
		return $result;
	}

	function reportEntry($kalturaSessionUser, $moderation)
	{
		$params = array();
		$this->addOptionalParam($params, "moderation_comments", $moderation->comments);
		$this->addOptionalParam($params, "moderation_objectType", $moderation->objectType);
		$this->addOptionalParam($params, "moderation_objectId", $moderation->objectId);

		$result = $this->hit("reportentry", $kalturaSessionUser, $params);
		return $result;
	}

	function reportKShow($kalturaSessionUser, $moderation)
	{
		$params = array();
		$this->addOptionalParam($params, "moderation_comments", $moderation->comments);
		$this->addOptionalParam($params, "moderation_objectType", $moderation->objectType);
		$this->addOptionalParam($params, "moderation_objectId", $moderation->objectId);

		$result = $this->hit("reportkshow", $kalturaSessionUser, $params);
		return $result;
	}

	function rollbackKShow($kalturaSessionUser, $kshowId, $kshowVersion)
	{
		$params = array();
		$params["kshow_id"] = $kshowId;
		$params["kshow_version"] = $kshowVersion;

		$result = $this->hit("rollbackkshow", $kalturaSessionUser, $params);
		return $result;
	}

	function search($kalturaSessionUser, $mediaType, $mediaSource, $search, $authData, $page = 1, $pageSize = 10)
	{
		$params = array();
		$params["media_type"] = $mediaType;
		$params["media_source"] = $mediaSource;
		$params["search"] = $search;
		$params["auth_data"] = $authData;
		$this->addOptionalParam($params, "page", $page);
		$this->addOptionalParam($params, "page_size", $pageSize);

		$result = $this->hit("search", $kalturaSessionUser, $params);
		return $result;
	}

	function searchAuthData($kalturaSessionUser, $mediaSource, $username, $password)
	{
		$params = array();
		$params["media_source"] = $mediaSource;
		$params["username"] = $username;
		$params["password"] = $password;

		$result = $this->hit("searchauthdata", $kalturaSessionUser, $params);
		return $result;
	}

	function searchFromUrl($kalturaSessionUser, $url, $mediaType)
	{
		$params = array();
		$params["url"] = $url;
		$params["media_type"] = $mediaType;

		$result = $this->hit("searchfromurl", $kalturaSessionUser, $params);
		return $result;
	}

	function searchMediaInfo($kalturaSessionUser)
	{
		$params = array();

		$result = $this->hit("searchmediainfo", $kalturaSessionUser, $params);
		return $result;
	}

	function searchmediaproviders($kalturaSessionUser)
	{
		$params = array();

		$result = $this->hit("searchmediaproviders", $kalturaSessionUser, $params);
		return $result;
	}

	function setMetaData($kalturaSessionUser, $entryId, $kshowId, $hasRoughCut, $xml)
	{
		$params = array();
		$params["entry_id"] = $entryId;
		$params["kshow_id"] = $kshowId;
		$params["HasRoughCut"] = $hasRoughCut;
		$params["xml"] = $xml;

		$result = $this->hit("setmetadata", $kalturaSessionUser, $params);
		return $result;
	}

	function startSession($kalturaSessionUser, $secret, $admin = null, $privileges = null, $expiry = 86400)
	{
		$params = array();
		$params["secret"] = $secret;
		$this->addOptionalParam($params, "admin", $admin);
		$this->addOptionalParam($params, "privileges", $privileges);
		$this->addOptionalParam($params, "expiry", $expiry);

		$result = $this->hit("startsession", $kalturaSessionUser, $params);
		return $result;
	}

	function startWidgetSession($kalturaSessionUser, $widgetId, $expiry = 86400)
	{
		$params = array();
		$params["widget_id"] = $widgetId;
		$this->addOptionalParam($params, "expiry", $expiry);

		$result = $this->hit("startwidgetsession", $kalturaSessionUser, $params);
		return $result;
	}

	function updateDvdEntry($kalturaSessionUser, $entryId, $entry)
	{
		$params = array();
		$params["entry_id"] = $entryId;
		$this->addOptionalParam($params, "entry_name", $entry->name);
		$this->addOptionalParam($params, "entry_tags", $entry->tags);
		$this->addOptionalParam($params, "entry_type", $entry->type);
		$this->addOptionalParam($params, "entry_mediaType", $entry->mediaType);
		$this->addOptionalParam($params, "entry_source", $entry->source);
		$this->addOptionalParam($params, "entry_sourceId", $entry->sourceId);
		$this->addOptionalParam($params, "entry_sourceLink", $entry->sourceLink);
		$this->addOptionalParam($params, "entry_licenseType", $entry->licenseType);
		$this->addOptionalParam($params, "entry_credit", $entry->credit);
		$this->addOptionalParam($params, "entry_groupId", $entry->groupId);
		$this->addOptionalParam($params, "entry_partnerData", $entry->partnerData);
		$this->addOptionalParam($params, "entry_conversionQuality", $entry->conversionQuality);
		$this->addOptionalParam($params, "entry_permissions", $entry->permissions);
		$this->addOptionalParam($params, "entry_dataContent", $entry->dataContent);
		$this->addOptionalParam($params, "entry_desiredVersion", $entry->desiredVersion);
		$this->addOptionalParam($params, "entry_url", $entry->url);
		$this->addOptionalParam($params, "entry_thumbUrl", $entry->thumbUrl);
		$this->addOptionalParam($params, "entry_filename", $entry->filename);
		$this->addOptionalParam($params, "entry_realFilename", $entry->realFilename);
		$this->addOptionalParam($params, "entry_indexedCustomData1", $entry->indexedCustomData1);
		$this->addOptionalParam($params, "entry_thumbOffset", $entry->thumbOffset);
		$this->addOptionalParam($params, "entry_mediaId", $entry->mediaId);

		$result = $this->hit("updatedvdentry", $kalturaSessionUser, $params);
		return $result;
	}

	function updateEntriesThumbnails($kalturaSessionUser, $entryIds, $timeOffset)
	{
		$params = array();
		$params["entry_ids"] = $entryIds;
		$params["time_offset"] = $timeOffset;

		$result = $this->hit("updateentriesthumbnails", $kalturaSessionUser, $params);
		return $result;
	}

	function updateEntry($kalturaSessionUser, $entryId, $entry)
	{
		$params = array();
		$params["entry_id"] = $entryId;
		$this->addOptionalParam($params, "entry_name", $entry->name);
		$this->addOptionalParam($params, "entry_tags", $entry->tags);
		$this->addOptionalParam($params, "entry_type", $entry->type);
		$this->addOptionalParam($params, "entry_mediaType", $entry->mediaType);
		$this->addOptionalParam($params, "entry_source", $entry->source);
		$this->addOptionalParam($params, "entry_sourceId", $entry->sourceId);
		$this->addOptionalParam($params, "entry_sourceLink", $entry->sourceLink);
		$this->addOptionalParam($params, "entry_licenseType", $entry->licenseType);
		$this->addOptionalParam($params, "entry_credit", $entry->credit);
		$this->addOptionalParam($params, "entry_groupId", $entry->groupId);
		$this->addOptionalParam($params, "entry_partnerData", $entry->partnerData);
		$this->addOptionalParam($params, "entry_conversionQuality", $entry->conversionQuality);
		$this->addOptionalParam($params, "entry_permissions", $entry->permissions);
		$this->addOptionalParam($params, "entry_dataContent", $entry->dataContent);
		$this->addOptionalParam($params, "entry_desiredVersion", $entry->desiredVersion);
		$this->addOptionalParam($params, "entry_url", $entry->url);
		$this->addOptionalParam($params, "entry_thumbUrl", $entry->thumbUrl);
		$this->addOptionalParam($params, "entry_filename", $entry->filename);
		$this->addOptionalParam($params, "entry_realFilename", $entry->realFilename);
		$this->addOptionalParam($params, "entry_indexedCustomData1", $entry->indexedCustomData1);
		$this->addOptionalParam($params, "entry_thumbOffset", $entry->thumbOffset);
		$this->addOptionalParam($params, "entry_mediaId", $entry->mediaId);

		$result = $this->hit("updateentry", $kalturaSessionUser, $params);
		return $result;
	}

	function updateEntryThumbnail($kalturaSessionUser, $entryId, $sourceEntryId = null, $timeOffset = null)
	{
		$params = array();
		$params["entry_id"] = $entryId;
		$this->addOptionalParam($params, "source_entry_id", $sourceEntryId);
		$this->addOptionalParam($params, "time_offset", $timeOffset);

		$result = $this->hit("updateentrythumbnail", $kalturaSessionUser, $params);
		return $result;
	}

	function updateEntryThumbnailJpeg($kalturaSessionUser, $entryId)
	{
		$params = array();
		$params["entry_id"] = $entryId;

		$result = $this->hit("updateentrythumbnailjpeg", $kalturaSessionUser, $params);
		return $result;
	}

	function updateKShow($kalturaSessionUser, $kshowId, $kshow, $detailed = null, $allowDuplicateNames = null)
	{
		$params = array();
		$params["kshow_id"] = $kshowId;
		$this->addOptionalParam($params, "kshow_name", $kshow->name);
		$this->addOptionalParam($params, "kshow_description", $kshow->description);
		$this->addOptionalParam($params, "kshow_tags", $kshow->tags);
		$this->addOptionalParam($params, "kshow_indexedCustomData3", $kshow->indexedCustomData3);
		$this->addOptionalParam($params, "kshow_groupId", $kshow->groupId);
		$this->addOptionalParam($params, "kshow_permissions", $kshow->permissions);
		$this->addOptionalParam($params, "kshow_partnerData", $kshow->partnerData);
		$this->addOptionalParam($params, "kshow_allowQuickEdit", $kshow->allowQuickEdit);
		$this->addOptionalParam($params, "detailed", $detailed);
		$this->addOptionalParam($params, "allow_duplicate_names", $allowDuplicateNames);

		$result = $this->hit("updatekshow", $kalturaSessionUser, $params);
		return $result;
	}

	function updateKshowOwner($kalturaSessionUser, $kshowId, $detailed = null)
	{
		$params = array();
		$params["kshow_id"] = $kshowId;
		$this->addOptionalParam($params, "detailed", $detailed);

		$result = $this->hit("updatekshowowner", $kalturaSessionUser, $params);
		return $result;
	}

	function updateNotification($kalturaSessionUser, $notification)
	{
		$params = array();
		$this->addOptionalParam($params, "notification_id", $notification->id);
		$this->addOptionalParam($params, "notification_status", $notification->status);
		$this->addOptionalParam($params, "notification_notificationResult", $notification->notificationResult);

		$result = $this->hit("updatenotification", $kalturaSessionUser, $params);
		return $result;
	}

	function updateUser($kalturaSessionUser, $userId, $user)
	{
		$params = array();
		$params["user_id"] = $userId;
		$this->addOptionalParam($params, "user_screenName", $user->screenName);
		$this->addOptionalParam($params, "user_fullName", $user->fullName);
		$this->addOptionalParam($params, "user_email", $user->email);
		$this->addOptionalParam($params, "user_dateOfBirth", $user->dateOfBirth);
		$this->addOptionalParam($params, "user_aboutMe", $user->aboutMe);
		$this->addOptionalParam($params, "user_tags", $user->tags);
		$this->addOptionalParam($params, "user_gender", $user->gender);
		$this->addOptionalParam($params, "user_country", $user->country);
		$this->addOptionalParam($params, "user_state", $user->state);
		$this->addOptionalParam($params, "user_city", $user->city);
		$this->addOptionalParam($params, "user_zip", $user->zip);
		$this->addOptionalParam($params, "user_urlList", $user->urlList);
		$this->addOptionalParam($params, "user_networkHighschool", $user->networkHighschool);
		$this->addOptionalParam($params, "user_networkCollege", $user->networkCollege);
		$this->addOptionalParam($params, "user_partnerData", $user->partnerData);

		$result = $this->hit("updateuser", $kalturaSessionUser, $params);
		return $result;
	}

	function updateUserId($kalturaSessionUser, $userId, $newUserId)
	{
		$params = array();
		$params["user_id"] = $userId;
		$params["new_user_id"] = $newUserId;

		$result = $this->hit("updateuserid", $kalturaSessionUser, $params);
		return $result;
	}

	function upload($kalturaSessionUser, $filename)
	{
		$params = array();
		$params["filename"] = $filename;

		$result = $this->hit("upload", $kalturaSessionUser, $params);
		return $result;
	}

	function uploadJpeg($kalturaSessionUser, $filename, $hash)
	{
		$params = array();
		$params["filename"] = $filename;
		$params["hash"] = $hash;

		$result = $this->hit("uploadjpeg", $kalturaSessionUser, $params);
		return $result;
	}

	function viewWidget($kalturaSessionUser, $entryId = null, $kshowId = null, $widgetId = null, $host = null)
	{
		$params = array();
		$this->addOptionalParam($params, "entry_id", $entryId);
		$this->addOptionalParam($params, "kshow_id", $kshowId);
		$this->addOptionalParam($params, "widget_id", $widgetId);
		$this->addOptionalParam($params, "host", $host);

		$result = $this->hit("viewwidget", $kalturaSessionUser, $params);
		return $result;
	}

}
?>
