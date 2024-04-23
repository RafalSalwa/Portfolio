import React, {useEffect, useState} from 'react';
import {useParams} from "react-router-dom";
import {apiToolsListEndpoint} from "../config/endpoints";

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

const Contact: React.FC = () => {
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
            <div className="container-xxl my-5 mt-15">
                <header className="section-header my-5">
                    <h3 className="section-title my-5">Contact</h3>
                </header>

                <div className="row about-cols">
                </div>
            </div>
        </section>
    )
}

export default Contact;