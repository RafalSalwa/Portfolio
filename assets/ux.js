import 'bootstrap/dist/css/bootstrap.css';
import './vendor/aos/aos.css';
import './vendor/boxicons/css/boxicons.min.css';
import './vendor/glightbox/css/glightbox.min.css';
import './vendor/swiper/swiper-bundle.min.css';
import './vendor/animate/animate.css';
import './vendor/ionicons/css/ionicons.css';
import './styles/style.css';
import './styles/ux.css';

import './vendor/aos/aos';
import './vendor/glightbox/js/glightbox.min';
import './vendor/isotope-layout/isotope.pkgd.min';
import './vendor/swiper/swiper-bundle.min';
import 'bootstrap/dist/js/bootstrap.bundle';

import './scripts/ux';

import {startStimulusApp} from '@symfony/stimulus-bridge';

export const ux = startStimulusApp(require.context(
    '@symfony/stimulus-bridge/lazy-controller-loader!./controllers',
    true,
    /\.[jt]sx?$/
));