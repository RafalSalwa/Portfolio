import React, {ReactNode} from "react";
import Header from "./Header";
import {urlHomepage} from "../../config/config";

interface LayoutProps {
    children: ReactNode;
}

const Layout: React.FC<LayoutProps> = ({children}) => {

    return (
        <div>
            <Header/>
            <main id="main" className="scrolled-offset">
                <section className="breadcrumbs">
                    <div className="container">

                        <div className="d-flex justify-content-between align-items-center">
                            <h2>React</h2>
                            <ol>
                                <li><a href={urlHomepage}>Home</a></li>
                                <li>React</li>
                            </ol>
                        </div>
                    </div>
                </section>
                {children}
            </main>
        </div>
    );
};

export default Layout;
