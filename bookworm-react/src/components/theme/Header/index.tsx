import React from "react"

const Header = () => {
    return (
        <header className="header flex flex-row">
            <div className="user w-28">
                <div className="avatar" style={{backgroundImage: "url(https://picsum.photos/150/150)"}}></div>
            </div>
            <div className="radical flex-1">
                <h1 className="pl-5"><span>RAD</span>ICAL</h1>
            </div>
        </header>
    )
}

export default Header