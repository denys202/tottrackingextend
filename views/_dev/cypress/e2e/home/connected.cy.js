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

describe('Connected event', () => {
    beforeEach(() => {
        cy.visit('/en/')
    })

    it('Should check if { “Connected”: “No” } is added in the dataLayer', () => {
        cy.wait(2000);
        cy.window().then((win) => {
            // Attendre que le dataLayer existe
            expect(win).to.have.property('dataLayer');

            // Chercher l'objet { "Connecte": "Non" } dans le dataLayer
            const connecteNonExiste = win.dataLayer.some((entry) => entry.Connecte === 'Non');

            // Assertion : vérifier que l'objet existe bien dans le dataLayer
            expect(connecteNonExiste).to.be.true;
        });
    });
})
