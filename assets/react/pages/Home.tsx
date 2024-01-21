import React, {useEffect, useState} from 'react';
import ImageCard from "../components/ImageCard";
import apiHomepageEndpoint from "../config/endpoints";

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
    }, [data]);

    return (
        <section id="about" className="about">
            <div className="container">
                <div className="section-title">
                    <h2>Tech stack</h2>
                </div>
                {isLoading ? (
                    <div>Loading...</div>
                ) : (
                    <div className="row">
                        {data!.map((item) => <ImageCard key={item.id} {...item} />)}
                    </div>
                )}
            </div>
        </section>
    );
};

export default Home;
