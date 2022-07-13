<?php
defined('TYPO3') || die();

(static function() {
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_hour_domain_model_hour', 'EXT:hour/Resources/Private/Language/locallang_csh_tx_hour_domain_model_hour.xlf');
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_hour_domain_model_hour');
})();
