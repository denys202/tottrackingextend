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
describe('Testing the view_item event on the product page', () => {
    it('Should check if the view_item event is triggered with the right price and information', () => {
        cy.visit('/en/home-accessories/6-mug-the-best-is-yet-to-come.html');
        cy.wait(2000);
        cy.window().then((win) => {
            expect(win).to.have.property('dataLayer');
            const viewItemEvent = win.dataLayer.find((entry) => entry.event === 'view_item');
            expect(viewItemEvent).to.exist;
            const item = viewItemEvent.ecommerce.items[0];
            expect(item).to.have.property('price', 11.9);
        });
    });
});
