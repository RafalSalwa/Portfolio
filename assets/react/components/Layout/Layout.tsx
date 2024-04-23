import React, {Suspense} from "react";
import Header from "./Header";
import {Outlet} from "react-router-dom";

const Layout: React.FC = () => {

    return (
        <>
            <Header/>
            <Suspense fallback={<div>Loading...</div>}>
                <Outlet/>
            </Suspense>
        </>
    );
};

export default Layout;
