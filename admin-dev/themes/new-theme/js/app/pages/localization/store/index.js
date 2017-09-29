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
import Vue from 'vue';
import Vuex from 'vuex';
import VueResource from 'vue-resource';
import { showGrowl } from 'app/utils/growl';
import _ from 'lodash';

Vue.use(Vuex);
Vue.use(VueResource);

const state = {
  translations: {},
  currencies: [],
  currency: {},
  isReady: false,
  currentLocalization: {},
  localizations: [],
  currentCurrencyUrl: null,
};

const actions = {
  getTranslations: () => {
    const url = window.data.translationUrl;
    Vue.http.get(url).then((response) => {
      response.body.data.forEach((t) => {
        state.translations[t.translation_id] = t.name;
      });
      state.isReady = true;
    }, (error) => {
      showGrowl('error', error.statusText);
    });
  },
  getCurrency: () => {
    const apiLocalizationCurrencyUrl = window.data.apiLocalizationCurrencyUrl;
    const url = state.currentCurrencyUrl ? state.currentCurrencyUrl : apiLocalizationCurrencyUrl;
    Vue.http.get(url).then((response) => {
      state.currency = response.body.data;
      state.currentCurrencyUrl = response.body.info.current_url;
    }, (error) => {
      showGrowl('error', error.statusText);
    });
  },
  getCurrencies: () => {
    const url = window.data.apiLocalizationCurrenciesUrl;
    Vue.http.get(url).then((response) => {
      state.currencies = response.body.data;
    }, (error) => {
      showGrowl('error', error.statusText);
    });
  },
};

const getters = {
  currentLocalization: () =>  _.find(state.currency.localizations, { isCurrent: true }),
  localizations: () => {
    _.forEach(state.currency.localizations, (localization) => {
      state.localizations.push(localization);
    });
    return state.localizations;
  },
};

export default new Vuex.Store({
  state,
  actions,
  getters,
});
