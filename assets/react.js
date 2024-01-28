import './styles/ux.css';
import './styles/react.css';
import 'bootstrap/dist/css/bootstrap.css';
import React, {StrictMode} from 'react';
import {QueryClient, QueryClientProvider} from "react-query";
import ReactDOM from "react-dom/client";
import Layout from "./react/components/Layout/Layout";
import {ApplicationRouter} from "./react/Routes/Router";

const queryClient = new QueryClient();
const root = ReactDOM.createRoot(document.getElementById('reactRoot'));
root.render(
    <StrictMode>
        <QueryClientProvider client={queryClient}>
            <Layout>
                <ApplicationRouter/>
            </Layout>
        </QueryClientProvider>
    </StrictMode>
);
