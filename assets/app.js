import './vendor/aos/aos.css';
import './vendor/animate/animate.min.css';
import './vendor/bootstrap/css/bootstrap.min.css';
import './vendor/ionicons/css/ionicons.css';
import './styles/style.css';
import './styles/app.css';
import './scripts/main';
import './scripts/cookies_disclaimer';
import 'bootstrap/dist/js/bootstrap.bundle';
import {startStimulusApp} from '@symfony/stimulus-bridge';

export const app = startStimulusApp(require.context(
    '@symfony/stimulus-bridge/lazy-controller-loader!./controllers',
    true,
    /\.[jt]sx?$/
));

