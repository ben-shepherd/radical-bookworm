import ArrowLongLeft from "components/icons/ArrowLongLeft";
import { useNavigate } from "react-router-dom";
import './styles.scss';

type Props = {
    url: string;
    text: string;
    onClick?: (...args: any[]) => any;
}

const ReturnToLink = ({ url, text, onClick }: Props) => {
    const navigate = useNavigate();

    const handleClick = (e: any) => {
        e.preventDefault()

        if(typeof onClick === 'function') {
            onClick()
        }

        navigate(url)
    }

    return (
        <div className="ReturnToLink">
            <ArrowLongLeft />
            <p className="text">Return to:</p>
            <a className="link" href={url} onClick={handleClick}>{text}</a>
        </div>
    )
}

export default ReturnToLink