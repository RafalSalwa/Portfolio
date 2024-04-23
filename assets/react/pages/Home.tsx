import React, {useEffect, useState} from 'react';
import ImageCard from "../components/ImageCard";
import apiHomepageEndpoint from "../config/endpoints";

let AOS = require('../../vendor/aos/aos');

interface LangItem {
    id: number,
    name: string,
    img: string
}

interface HomepageData {
    stack: LangItem[];
}

const Home: React.FC = () => {
    const [data, setData] = useState<LangItem[] | null>(null);
    const [isLoading, setIsLoading] = useState(true);

    useEffect(() => {
        if (!data) {
            fetch(apiHomepageEndpoint)
                .then(response => response.json() as Promise<HomepageData>)
                .then(result => {
                    setData(result.stack);
                    setIsLoading(false);
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                    setIsLoading(false);
                });
        }
        AOS.init();
    }, [data]);

    return (
        <section id="portfolio">
            <div className="container-xxl my-5 mt-15">
                <header className="section-header my-5">
                    <h3 className="section-title my-5">Tech stack</h3>
                </header>

                <div className="row d-flex align-items-center justify-content-center">
                    {isLoading ? (
                        <div>Loading...</div>
                    ) : (
                        data!.map((item) => <ImageCard key={item.id}
                                                       id={item.id}
                                                       name={item.name}
                                                       url={item.name}
                                                       img={item.img}/>)
                    )}
                </div>
            </div>
        </section>
    );
};

export default Home;
