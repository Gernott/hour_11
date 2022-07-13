<?php

declare(strict_types=1);

namespace WEBprofil\Hour\Tests\Unit\Controller;

use PHPUnit\Framework\MockObject\MockObject;
use TYPO3\TestingFramework\Core\AccessibleObjectInterface;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;
use TYPO3Fluid\Fluid\View\ViewInterface;

/**
 * Test case
 */
class HourControllerTest extends UnitTestCase
{
    /**
     * @var \WEBprofil\Hour\Controller\HourController|MockObject|AccessibleObjectInterface
     */
    protected $subject;

    protected function setUp(): void
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder($this->buildAccessibleProxy(\WEBprofil\Hour\Controller\HourController::class))
            ->onlyMethods(['redirect', 'forward', 'addFlashMessage'])
            ->disableOriginalConstructor()
            ->getMock();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function listActionFetchesAllHoursFromRepositoryAndAssignsThemToView(): void
    {
        $allHours = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $hourRepository = $this->getMockBuilder(\WEBprofil\Hour\Domain\Repository\HourRepository::class)
            ->onlyMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $hourRepository->expects(self::once())->method('findAll')->will(self::returnValue($allHours));
        $this->subject->_set('hourRepository', $hourRepository);

        $view = $this->getMockBuilder(ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('hours', $allHours);
        $this->subject->_set('view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenHourToView(): void
    {
        $hour = new \WEBprofil\Hour\Domain\Model\Hour();

        $view = $this->getMockBuilder(ViewInterface::class)->getMock();
        $this->subject->_set('view', $view);
        $view->expects(self::once())->method('assign')->with('hour', $hour);

        $this->subject->showAction($hour);
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenHourToHourRepository(): void
    {
        $hour = new \WEBprofil\Hour\Domain\Model\Hour();

        $hourRepository = $this->getMockBuilder(\WEBprofil\Hour\Domain\Repository\HourRepository::class)
            ->onlyMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $hourRepository->expects(self::once())->method('add')->with($hour);
        $this->subject->_set('hourRepository', $hourRepository);

        $this->subject->createAction($hour);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenHourToView(): void
    {
        $hour = new \WEBprofil\Hour\Domain\Model\Hour();

        $view = $this->getMockBuilder(ViewInterface::class)->getMock();
        $this->subject->_set('view', $view);
        $view->expects(self::once())->method('assign')->with('hour', $hour);

        $this->subject->editAction($hour);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenHourInHourRepository(): void
    {
        $hour = new \WEBprofil\Hour\Domain\Model\Hour();

        $hourRepository = $this->getMockBuilder(\WEBprofil\Hour\Domain\Repository\HourRepository::class)
            ->onlyMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $hourRepository->expects(self::once())->method('update')->with($hour);
        $this->subject->_set('hourRepository', $hourRepository);

        $this->subject->updateAction($hour);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenHourFromHourRepository(): void
    {
        $hour = new \WEBprofil\Hour\Domain\Model\Hour();

        $hourRepository = $this->getMockBuilder(\WEBprofil\Hour\Domain\Repository\HourRepository::class)
            ->onlyMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $hourRepository->expects(self::once())->method('remove')->with($hour);
        $this->subject->_set('hourRepository', $hourRepository);

        $this->subject->deleteAction($hour);
    }
}
