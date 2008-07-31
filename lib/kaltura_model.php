<?php
class KalturaModel 
{
	static function getKshow($kalturaClient, $kshowId) 
	{
		$sessionUser = kalturaGetSessionUser();
		$ks = $kalturaClient->getKs();
		$result = $kalturaClient->getKShow($sessionUser, $kshowId, true);
		return @$result["result"]["kshow"];
	}
	
	static function updateKshow($kalturaClient, $kshowId, $kshowUpdate)
	{
		$sessionUser = kalturaGetSessionUser();
		$kalturaClient->updateKShow($sessionUser, $kshowId, $kshowUpdate);
	}
	
	static function getKshows($kalturaAdminClient, $pageSize, $page)
	{
		$sessionUser = kalturaGetSessionUser();
					
		$filter = new KalturaKShowFilter();
		$filter->orderBy = KalturaKShowFilter::ORDER_BY_CREATED_AT_DESC;
		$result = $kalturaAdminClient->listKShows($sessionUser, $filter, true, $pageSize, $page);
		return $result["result"];
	}
	
	static function addKshow($kalturaClient, $kshow)
	{
		$sessionUser = kalturaGetSessionUser();
		$res = $kalturaClient->addKShow($sessionUser, $kshow);
		return @$res["result"]["kshow"]["id"];
	}

	static function getPartner($kalturaClient, $email, $password, $partnerId)
	{
		$sessionUser = kalturaGetSessionUser();
		$res = $kalturaClient->getPartner($sessionUser, $email, $password, $partnerId);
		return @$res;
	}

	static function getLastKshow($kalturaClient)
	{
		$sessionUser = kalturaGetSessionUser();
		$filter = new KalturaKShowFilter();
		$filter->orderBy = KalturaKShowFilter::ORDER_BY_CREATED_AT_DESC;
		$res = $kalturaClient->listMyKShows($sessionUser, $filter, "true", 1, 1);
		return @$res["result"]["kshows"][0];
	}
	
	static function deleteKShow($kalturaAdminClient, $kshowId)
	{
		$sessionUser = kalturaGetSessionUser();
		return $kalturaAdminClient->deleteKShow($sessionUser, $kshowId);
	}
}
?>