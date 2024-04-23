import 'bootstrap/dist/css/bootstrap.css';
import './vendor/animate/animate.css';
import './vendor/aos/aos.css';
import './styles/style.css';
import './styles/ux.css';
import './styles/react.css';

import './vendor/aos/aos';
import 'bootstrap/dist/js/bootstrap.bundle';

import React, {StrictMode} from 'react';
import {QueryClient, QueryClientProvider} from "react-query";
import ReactDOM from "react-dom/client";
import Layout from "./react/components/Layout/Layout";
import {ApplicationRouter} from "./react/Routes/Router";

import {startStimulusApp} from '@symfony/stimulus-bridge';

export const react = startStimulusApp(require.context(
    '@symfony/stimulus-bridge/lazy-controller-loader!./controllers',
    true,
    /\.[jt]sx?$/
));

const queryClient = new QueryClient();
const root = ReactDOM.createRoot(document.getElementById('reactRoot'));
root.render(
    <StrictMode>
        <ApplicationRouter>
            <QueryClientProvider client={queryClient}>
                <Layout>
                </Layout>
            </QueryClientProvider>
        </ApplicationRouter>
    </StrictMode>
);
