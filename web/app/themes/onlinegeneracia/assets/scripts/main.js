/** import external dependencies */
// import 'bootstrap';
// import 'bootstrap/js/src/util'
// import 'bootstrap/js/src/scrollspy'

// import Siema from 'siema/src/siema'

/** import local dependencies */
import Router from './util/Router'
import common from './routes/common'
import home from './routes/home'
import kontakt from './routes/kontakt'
import novinky from './routes/novinky'
import taxTopic from './routes/taxonomyTopic'
import documentReady from './util/documentReady'

/**
 * Populate Router instance with DOM routes
 * @type {Router} routes - An instance of our router
 */
const routes = new Router({
  /** All pages */
  common,
  /** Home page */
  home,
  /** Contact page */
  kontakt,
  /** Novinky page */
  novinky,
  /** About Us page, note the change from about-us to aboutUs. */
  taxTopic,
});

// new Siema({})

/** Load Events */

documentReady(() => routes.loadEvents())
