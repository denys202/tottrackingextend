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

/// <reference types="cypress" />

describe('Test footer link click and dataLayer event', () => {
    beforeEach(() => {
        cy.visit('/en/')
    })

    it('Should verify dataLayer event before navigation when clicking footer link', () => {
        cy.window().then((win) => {
            expect(win).to.have.property('dataLayer');
            const dataLayerPushSpy = cy.spy(win.dataLayer, 'push').as('dataLayerPush');
        });

        const $link = cy.get('footer ul li a[title]').first().then($link => {
            const titleText = $link.attr('title');

            // Ensure title attribute exists
            expect(titleText).to.exist;

            cy.wrap($link).click();
            cy.get('@dataLayerPush').should('be.calledWith', {
                event: 'click_nav',
                click_text: titleText,
                nav_type: 'Footer'
            });
        });
    });
})
