/** import external dependencies */
// import 'bootstrap';
// import 'bootstrap/js/src/util'
// import 'bootstrap/js/src/scrollspy'

// import Siema from 'siema/src/siema'

/** import local dependencies */
import Router from './util/Router'
import common from './routes/common'
import home from './routes/home'
import aboutUs from './routes/about'
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
  /** About Us page, note the change from about-us to aboutUs. */
  aboutUs,
});

// new Siema({})

/** Load Events */

documentReady(() => routes.loadEvents())
