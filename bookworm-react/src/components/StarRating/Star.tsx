import React from 'react';
import { default as StarOutlineIcon } from 'components/icons/StarOutline'
import { default as StarSolidIcon } from 'components/icons/StarSolid'

type Props = {
    active: boolean,
    onClick: (...args: any[]) => any;
}

const Star = ({ active = false, onClick }: Props) => {
    return (
        <div className={`star ${active ? 'active' : ''}`}>
            {active ? <StarSolidIcon /> : <StarOutlineIcon />}
        </div>
    )
}

export default Star