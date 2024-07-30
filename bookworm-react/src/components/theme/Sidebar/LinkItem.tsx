import React from 'react';

type Props = {
    href: string;
    title: string;
    icon: JSX.Element;
    active: boolean;
}

const LinkItem = ({ href, title, icon, active }: Props) => {
    return (
        <li className={active ? 'active' : ''}>
            <a href={href} title={title}>
                {icon} <p className='text'>{title}</p>
            </a>
            <div className='divider'></div>
        </li>
    )
}

export default LinkItem