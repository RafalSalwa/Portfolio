import {createBrowserRouter} from "react-router-dom";
import Index from "../components/Index";

export const ApplicationRouter = createBrowserRouter([
    {
        path: "/",
        element: <Index/>,
    },
    {
        path: "about",
        element: <div>About</div>,
    },
]);


// (): React.ReactNode => (
//     <Routes>
//         <Route path="/" element={<Index/>}/>
//         <Route path="/users" element={<Users/>}/>
//         <Route path="/posts" element={<Posts/>}/>
//     </Routes>
// )
