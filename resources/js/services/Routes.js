import Dashboard from "../components/Dashboard";
import Loader from "../components/loader";

const allUrls = [
    {
        path: '/panel', component: Loader, redirect: '/panel/dashboard', children: [
            {path: 'dashboard', name: "admin", component: Dashboard},
        ]
    }
]
export default allUrls;
