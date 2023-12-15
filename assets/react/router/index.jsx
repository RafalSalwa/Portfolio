import React from 'react';
import {createBrowserRouter} from "react-router-dom";
import Home from "../components/Home";
import Users from "../components/Users";
import Posts from "../components/Posts";

export const ApplicationRouter = createBrowserRouter([
    {
        path: "/",
        element: <Home/>,
    },
    {
        path: "/users",
        element: <Users/>,
    },
    {
        path: "/posts",
        element: <Posts/>,
    },
]);
