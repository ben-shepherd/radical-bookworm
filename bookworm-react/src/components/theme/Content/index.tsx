import React from 'react';

type Props = {
    id: string;
    children: React.ReactNode
}

const Content = ({ children, id }: Props) => {
    return (
        <section id={id} className='Content flex justify-center w-full'>
            <div className="container w-5/6 sm:mx-3 mt-6">
                {children}
            </div>
        </section>
    )
}

export default Content