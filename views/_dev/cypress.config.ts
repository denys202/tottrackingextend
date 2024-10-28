import { defineConfig } from "cypress";

export default defineConfig({
  e2e: {
    setupNodeEvents(on, config) {},
    baseUrl: 'https://prestashop820.denys.tot',
    video: false,
    chromeWebSecurity: false,
  },
});
