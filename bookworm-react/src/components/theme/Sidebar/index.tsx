import { useLocation } from "react-router-dom"
import ChartBar from "../../icons/ChartBar"
import Cog from "../../icons/Cog"
import Heart from "../../icons/Heart"
import LinkItem from "./LinkItem"

const Sidebar = () => {
    const location = useLocation()
    const locationPathname = location.pathname

    return (
        <div className="Sidebar w-28 flex">
            <ul>
                <LinkItem href="/" title="Home" icon={<ChartBar />} active={locationPathname === '/'} />
                <LinkItem href="/favourites" title="Favourites" icon={<Heart />} active={locationPathname === '/favourites'} />
                <LinkItem href="/edit/0" title="Edit" icon={<Cog />} active={locationPathname.startsWith('/edit')} />
            </ul>
        </div>
    )
}

export default Sidebar