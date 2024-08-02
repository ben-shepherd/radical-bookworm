import Star from './Star';
import './styles.scss';
import {useState} from "react";

type Props = {
    rating: number;
    onClick: (value: number) => any;
}

const StarRating = ({ rating = 0, onClick }: Props) => {

    const [mouseOnNumber, setMouseOnNumber] = useState<number | null>(null);

    const oneActive: boolean = Boolean(rating >= 1 || (mouseOnNumber && mouseOnNumber >= 1));
    const twoActive: boolean = Boolean(rating >= 2 || (mouseOnNumber && mouseOnNumber >= 2));
    const threeActive: boolean = Boolean(rating >= 3 || (mouseOnNumber && mouseOnNumber >= 3));
    const fourActive: boolean = Boolean(rating >= 4 || (mouseOnNumber && mouseOnNumber >= 4));
    const fiveActive: boolean = Boolean(rating >= 5 || (mouseOnNumber && mouseOnNumber >= 5));

    return (
        <div className='StarRating' onMouseLeave={() => setMouseOnNumber(null)}>
            <Star number={1} active={oneActive} onClick={() => onClick(1)} onMouseEnter={setMouseOnNumber} />
            <Star number={2} active={twoActive} onClick={() => onClick(2)} onMouseEnter={setMouseOnNumber} />
            <Star number={3} active={threeActive} onClick={() => onClick(3)} onMouseEnter={setMouseOnNumber} />
            <Star number={4} active={fourActive} onClick={() => onClick(4)} onMouseEnter={setMouseOnNumber} />
            <Star number={5} active={fiveActive} onClick={() => onClick(5)} onMouseEnter={setMouseOnNumber} />
        </div>
    )
}

export default StarRating