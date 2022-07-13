<?php

declare(strict_types=1);

namespace WEBprofil\Hour\Controller;


/**
 * This file is part of the "Hour" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2022 
 */

/**
 * HourController
 */
class HourController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * hourRepository
     *
     * @var \WEBprofil\Hour\Domain\Repository\HourRepository
     */
    protected $hourRepository = null;

    /**
     * @param \WEBprofil\Hour\Domain\Repository\HourRepository $hourRepository
     */
    public function injectHourRepository(\WEBprofil\Hour\Domain\Repository\HourRepository $hourRepository)
    {
        $this->hourRepository = $hourRepository;
    }

    /**
     * action list
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function listAction(): \Psr\Http\Message\ResponseInterface
    {
        $hours = $this->hourRepository->findAll();
        $this->view->assign('hours', $hours);
        return $this->htmlResponse();
    }

    /**
     * action show
     *
     * @param \WEBprofil\Hour\Domain\Model\Hour $hour
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function showAction(\WEBprofil\Hour\Domain\Model\Hour $hour): \Psr\Http\Message\ResponseInterface
    {
        $this->view->assign('hour', $hour);
        return $this->htmlResponse();
    }

    /**
     * action new
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function newAction(): \Psr\Http\Message\ResponseInterface
    {
        return $this->htmlResponse();
    }

    /**
     * action create
     *
     * @param \WEBprofil\Hour\Domain\Model\Hour $newHour
     */
    public function createAction(\WEBprofil\Hour\Domain\Model\Hour $newHour)
    {
        $this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/p/friendsoftypo3/extension-builder/master/en-us/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->hourRepository->add($newHour);
        $this->redirect('list');
    }

    /**
     * action edit
     *
     * @param \WEBprofil\Hour\Domain\Model\Hour $hour
     * @TYPO3\CMS\Extbase\Annotation\IgnoreValidation("hour")
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function editAction(\WEBprofil\Hour\Domain\Model\Hour $hour): \Psr\Http\Message\ResponseInterface
    {
        $this->view->assign('hour', $hour);
        return $this->htmlResponse();
    }

    /**
     * action update
     *
     * @param \WEBprofil\Hour\Domain\Model\Hour $hour
     */
    public function updateAction(\WEBprofil\Hour\Domain\Model\Hour $hour)
    {
        $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/p/friendsoftypo3/extension-builder/master/en-us/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->hourRepository->update($hour);
        $this->redirect('list');
    }

    /**
     * action delete
     *
     * @param \WEBprofil\Hour\Domain\Model\Hour $hour
     */
    public function deleteAction(\WEBprofil\Hour\Domain\Model\Hour $hour)
    {
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/p/friendsoftypo3/extension-builder/master/en-us/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->hourRepository->remove($hour);
        $this->redirect('list');
    }
}
