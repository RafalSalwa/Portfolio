import React, {useEffect, useState} from 'react';
import {useParams} from "react-router-dom";
import {apiAppsListEndpoint} from "../config/endpoints";
import ImageCard from "../components/ImageCard";

interface AppItem {
    id: number,
    name: string,
    img: string,
    slug: string
}

interface AppData {
    apps: AppItem[];
}

const Apps: React.FC = () => {
    const params = useParams()
    const [data, setData] = useState<AppItem[] | null>(null);
    const [isLoading, setIsLoading] = useState(true);

    useEffect(() => {
        if (!data) {
            const requestOptions = {
                method: 'GET',
                headers: {'Content-Type': 'application/json'}
            };

            fetch(apiAppsListEndpoint + `/${params.lang}`, requestOptions)
                .then(response => response.json() as Promise<AppData>)
                .then(result => {
                    setData(result.apps);
                    setIsLoading(false);
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                    setIsLoading(false);
                });
        }
    }, [data]);

    return (
        <section id="portfolio">
            <div className="container-xxl my-5 mt-15">
                <header className="section-header my-5">
                    <h3 className="section-title my-5">{params.lang} Apps</h3>
                </header>
                <div className="row h-100 d-flex align-items-center justify-content-center ">
                    {data?.map((item) => <ImageCard key={item.id}
                                                    id={item.id}
                                                    name={item.name}
                                                    url={item.name}
                                                    img={item.img}
                    />)}
                </div>
            </div>
        </section>
    )
}

export default Apps;