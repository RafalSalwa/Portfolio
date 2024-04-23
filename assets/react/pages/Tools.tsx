import React, {useEffect, useState} from 'react';
import {useParams} from "react-router-dom";
import {apiToolsListEndpoint} from "../config/endpoints";
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
                })
                .catch(error => {
                    setIsLoading(false);
                });
        }
    }, [data]);

    return (
        <section id="about">
            <div className="container-xxl ">
                <header className="section-header">
                    <h3 className="section-title mb-5">{params.app} tools</h3>
                </header>

                <div className="row about-cols">
                    {data?.map((item) => <ToolCard key={item.id}
                                                   id={item.id}
                                                   name={item.name}
                                                   img={item.img}
                                                   url={item.url}
                                                   description={item.description}/>)}
                </div>
            </div>
        </section>
    )
}

export default Tools;