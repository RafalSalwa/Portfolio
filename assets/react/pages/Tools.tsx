import React, {useEffect, useState} from 'react';
import {useParams} from "react-router-dom";
import {apiToolsListEndpoint} from "../config/endpoints";
import {Sizes} from "../components/TextCard";
import ToolCard from "../components/ToolCard";

interface ToolItem {
    id: number,
    name: string,
    url: string;
    img: string,
    description: string;
}

interface ToolsData {
    tools: ToolItem[];
}

const Tools: React.FC = () => {
    const params = useParams()
    const [data, setData] = useState<ToolItem[] | null>(null);
    const [isLoading, setIsLoading] = useState(true);

    useEffect(() => {
        if (!data) {
            const requestOptions = {
                method: 'GET',
                headers: {'Content-Type': 'application/json'}
            };

            fetch(apiToolsListEndpoint + `/${params.app}`, requestOptions)
                .then(response => response.json() as Promise<ToolsData>)
                .then(result => {
                    setData(result.tools);
                    setIsLoading(false);
                    console.log(result.tools)
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                    setIsLoading(false);
                });
        }
    }, [data]);

    return (
        <section id="pricing" className="pricing pricing-offset section-bg">
            <div className="container">

                <div className="section-title aos-init aos-animate" data-aos="fade-up">
                    <h2>AuthApi stack</h2>
                </div>

                <div className="row">
                    {data?.map((item) => <ToolCard key={item.id}
                                                   id={item.id}
                                                   name={item.name}
                                                   img={item.img}
                                                   url={item.url}
                                                   description={item.description}
                                                   size={Sizes.Small}/>)}
                </div>
            </div>
        </section>
    )
}

export default Tools;