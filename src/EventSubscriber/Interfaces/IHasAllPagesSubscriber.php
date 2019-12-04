<?php
namespace App\EventSubscriber\Interfaces;

use App\Service\Content\PageService;

interface IHasAllPagesSubscriber
{
	function setPageService(PageService $page_service): void;
	function getAllPages(): array;
}
