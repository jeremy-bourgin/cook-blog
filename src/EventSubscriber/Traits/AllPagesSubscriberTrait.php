<?php
namespace App\EventSubscriber\Traits;

use App\Service\Content\PageService;

trait AllPagesSubscriberTrait
{
	protected $page_service;
	protected $all_pages;
	
	public function setPageService(PageService $page_service): void
	{
		$this->page_service = $page_service;
		$this->all_pages = $this->page_service->getAll();
	}

	public function getAllPages(): array
	{
		return $this->all_pages;
	}
}
