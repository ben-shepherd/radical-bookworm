import { useNavigate } from "react-router-dom";

type Props = {
    href: string;
    title: string;
    icon: JSX.Element;
    active: boolean;
}

const LinkItem = ({ href, title, icon, active }: Props) => {
    const navigate = useNavigate();

    const handleClick = () => {
        navigate(href)
    }

    return (
        <li className={`LinkItem ${active ? 'active' : ''}`}>
            <button onClick={handleClick}>
                {icon} <p className='text'>{title}</p>
                <div className='divider'></div>
            </button>
        </li>
    )
}

export default LinkItem