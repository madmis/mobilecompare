<?php

namespace App\Grabber\Entity\Embeddable;

/**
 * Class SystemOnChip
 * @package App\Grabber\Entity\Embeddable
 */
class SystemOnChip implements SystemOnChipInterface
{
    /**
     * The SoC integrates different hardware components such as the
     * CPU, GPU, memory, peripherals, interfaces, etc., as well as software for their functioning.
     *
     * @var string
     */
    private string $soC;

    /**
     * Information about the process technology used in manufacturing the chip.
     * The value in nanometers represents half the distance between elements that make up the CPU.
     *
     * @var string
     */
    private string $processTechnology;

    /**
     * CPU is the Central Processing Unit or the processor of a mobile device.
     * Its main function is to interpret and execute instructions contained in software applications.
     *
     * @var string
     */
    private string $cpu;

    /**
     * The CPU bits are determined by the bit-size of the processor registers, address buses and data buses.
     * 64-bit CPUs provide better performance than 32-bit ones, which on their part perform better than 16-bit
     * processors.
     *
     * @var string
     */
    private string $cpuBits;

    /**
     * @var string
     */
    private string $cpuCores;

    /**
     * @var string
     */
    private string $cpuFrequency;

    /**
     * The instruction set architecture (ISA) is a set of commands used by the software to manage the CPU's work.
     * Information about the set of instructions the processor can execute.
     *
     * @var string
     */
    private string $instructionSet;

    /**
     * GPU is a graphical processing unit, which handles computation for 2D/3D graphics applications.
     * In mobile devices GPU is usually utilized by games, UI, video playback, etc.
     * GPU can also perform computation in applications traditionally handled by the CPU.
     *
     * @var string
     */
    private string $gpu;

    /**
     * @var string
     */
    private string $gpuCores;

    /**
     * @var string
     */
    private string $gpuFrequency;

    /**
     * RAM (Random-Access Memory) is used by the operating system and all installed applications.
     * Data in the RAM is lost after the device is turned off or restarted.
     *
     * @var string
     */
    private string $ramCapacity;

    /**
     * Information about the type of RAM used by the device.
     *
     * @var string
     */
    private string $ramType;

    /**
     * Information about the number of RAM channels integrated in the SoC.
     * More channels mean higher data transfer rates.
     *
     * @var string
     */
    private string $ramChannels;

    /**
     * @var string
     */
    private string $ramFrequency;

    /**
     * @var array
     *
     * @ORM\Column(type="json", nullable=false)
     */
    private array $features;
}
