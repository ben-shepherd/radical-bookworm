import { Route, Routes } from "react-router-dom"
import Favourites from "./components/Favourites"
import FavouriteSelected from "./components/FavouriteSelected"
import Home from "./components/Home"
import Settings from "./components/Settings"

const RoutesComponent = () => {
    return (
        <Routes>
            <Route {...{ exact: true, path: "/", Component: Home }} />
            <Route path="/favourites" Component={Favourites} />
            <Route path="/favourite/:id" Component={FavouriteSelected} />
            <Route path="/settings" Component={Settings} />
        </Routes>
    )
}

export default RoutesComponent