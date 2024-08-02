import { Route, Routes } from "react-router-dom"
import Favourites from "./components/Favourites"
import Edit from "./components/Edit"
import Home from "./components/Home"

const RoutesComponent = () => {
    return (
        <Routes>
            <Route {...{ exact: true, path: "/", Component: Home }} />
            <Route path="/favourites" Component={Favourites} />
            <Route path="/edit/:id" Component={Edit} />
        </Routes>
    )
}

export default RoutesComponent