import React, {Dispatch, SetStateAction} from 'react';
import {default as StarOutlineIcon} from 'components/icons/StarOutline'
import {default as StarSolidIcon} from 'components/icons/StarSolid'

type Props = {
    number: number;
    active: boolean,
    onClick: (...args: any[]) => any;
    onMouseEnter: Dispatch<SetStateAction<number | null>>
}

const Star = ({number, active = false, onClick, onMouseEnter}: Props) => {
    return (
        <div className={`star ${active ? 'active' : ''}`}>
            <button onClick={onClick} onMouseEnter={() => onMouseEnter(number)} tabIndex={number}>
                {active ? <StarSolidIcon/> : <StarOutlineIcon/>}
            </button>
        </div>
    )
}

export default Star