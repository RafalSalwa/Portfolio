import React, {useEffect, useState} from 'react';
import {useParams} from "react-router-dom";
import {apiAppsListEndpoint} from "../config/endpoints";
import TextCard, {Sizes} from "../components/TextCard";

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
        <section id="portfolio" className="portfolio">
            <div className="container">

                <div className="section-title aos-init aos-animate" data-aos="fade-up">
                    <h2>{params.lang} Apps</h2>
                </div>
                <div className="row ">
                    {data?.map((item) => <TextCard key={item.id}
                                                   id={item.id}
                                                   name={item.name}
                                                   img={item.img}
                                                   url={item.slug}
                                                   size={Sizes.Medium}/>)}
                </div>
            </div>
        </section>
    )
}

export default Apps;