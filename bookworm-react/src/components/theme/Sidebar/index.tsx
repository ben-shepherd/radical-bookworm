import React from "react"
import ChartBar from "../../icons/ChartBar"
import Heart from "../../icons/Heart"
import Cog from "../../icons/Cog"
import LinkItem from "./LinkItem"

const Sidebar = () => {
    return (
        <div className="Sidebar w-28 flex">
            <ul>
                <LinkItem href="/" title="Home" icon={<ChartBar />} active={true} />
                <LinkItem href="/favourites" title="Favourites" icon={<Heart />} active={false} />
                <LinkItem href="/settings" title="Settings" icon={<Cog />} active={false} />
            </ul>
        </div>
    )
}

export default Sidebar