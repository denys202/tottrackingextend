/*
 * NOTICE OF LICENSE
 *
 * This source file is subject to a commercial license from SARL 202 ecommerce
 * Use, copy, modification or distribution of this source file without written
 * license agreement from the SARL 202 ecommerce is strictly forbidden.
 * In order to obtain a license, please contact us: tech@202-ecommerce.com
 * ...........................................................................
 * INFORMATION SUR LA LICENCE D'UTILISATION
 *
 * L'utilisation de ce fichier source est soumise a une licence commerciale
 * concedee par la societe 202 ecommerce
 * Toute utilisation, reproduction, modification ou distribution du present
 * fichier source sans contrat de licence ecrit de la part de la SARL 202 ecommerce est
 * expressement interdite.
 * Pour obtenir une licence, veuillez contacter 202-ecommerce <tech@202-ecommerce.com>
 * ...........................................................................
 *
 * @author    202-ecommerce <tech@202-ecommerce.com>
 * @copyright Copyright (c) 202-ecommerce
 * @license   Commercial license
 */

import {DatalayerEvent} from "./DatalayerEvent.ts";

export default class CustomBouquetSubmitEvent extends DatalayerEvent {
  eventName: string = 'customBouquet';

  getParams(event: JQuery.TriggeredEvent): Object {
    window.dataLayer = window.dataLayer || [];
    const formData = {}; // form data params

    return fetch(window.prestashop.modules.tottrackingextend.customBouquetUrl, formData);
  }

  registerEvent(): void {
    $(document).on('click', '[submit-custom-bouquet]', (event: JQuery.TriggeredEvent) => {
      this.dispatch(this.getParams(event));
    })
  }

  dispatch(params: Object) {
    window.dataLayer.push({ecommerce: null});
    super.dispatch(params);
  }
}
