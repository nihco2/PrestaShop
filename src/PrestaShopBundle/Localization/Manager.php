<?php
/**
 * 2007-2017 PrestaShop
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/OSL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to http://www.prestashop.com for more information.
 *
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright 2007-2017 PrestaShop SA
 * @license   https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 * International Registered Trademark & Property of PrestaShop SA
 */

namespace PrestaShopBundle\Localization;

use PrestaShopBundle\Currency\Manager as CurrencyManager;

class Manager
{
    /**
     * The currency manager is useful to build complete prices strings (locale object gives number + currency pattern,
     * and currency object gives localized symbol)
     *
     * @var CurrencyManager
     */
    protected $currencyManager;
    protected $installedLocaleRepository;
    protected $referenceLocaleRepository;

    public function __construct(
        Repository $installedLocaleRepository,
        Repository $referenceLocaleRepository,
        CurrencyManager $currencyManager
    ) {
        $this->installedLocaleRepository = $installedLocaleRepository;
        $this->referenceLocaleRepository = $referenceLocaleRepository;
        $this->currencyManager           = $currencyManager;
    }

    /**
     * @return CurrencyManager
     */
    public function getCurrencyManager()
    {
        return $this->currencyManager;
    }

    public function getCurrency($id)
    {
        return $this->getCurrencyManager()->getCurrency((int)$id);
    }

    /**
     * Get a locale instance
     *
     * @param string $localeCode
     *
     * @return Locale
     */
    public function getLocale($localeCode)
    {
        return $this->getReferenceLocaleRepository()->getLocaleByCode($localeCode);
    }

    /**
     * @return Repository
     */
    public function getInstalledLocaleRepository()
    {
        return $this->installedLocaleRepository;
    }

    /**
     * @param $installedLocaleRepository
     *
     * @return $this
     */
    public function setInstalledLocaleRepository($installedLocaleRepository)
    {
        $this->installedLocaleRepository = $installedLocaleRepository;

        return $this;
    }

    /**
     * @return Repository
     */
    public function getReferenceLocaleRepository()
    {
        return $this->referenceLocaleRepository;
    }

    /**
     * @param $referenceLocaleRepository
     *
     * @return $this
     */
    public function setReferenceLocaleRepository($referenceLocaleRepository)
    {
        $this->referenceLocaleRepository = $referenceLocaleRepository;

        return $this;
    }
}
